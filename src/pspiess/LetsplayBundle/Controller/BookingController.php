<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Booking;
use pspiess\LetsplayBundle\Form\BookingType;
use JMS\Serializer\SerializerBuilder;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Response;
use \pspiess\LetsplayBundle\Service\BookingModel;

/**
 * Booking controller.
 *
 * @Route("/booking")
 */
class BookingController extends Controller {

    /**
     * Lists all Booking entities.
     *
     * @Route("/", name="booking")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {

        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository('pspiessLetsplayBundle:Category')->findAll();
        return array(
            'category' => $category,
        );
    }

    /**
     * Lists all Booking entities for Calendar.
     * @Route("/booking/{id}/{date}", name="pspiess_letsplay_booking_calendar", options={"expose"=true})
     */
    public function showCalendarAction($id, $date) {
        $sCategory = '';
        $iCategoryId = 0;
        $em = $this->getDoctrine()->getManager();

        $entBooking = $em->getRepository('pspiessLetsplayBundle:Booking')->GetBooking($id, $date);

        $rows = array();
        foreach ($entBooking as $obj) {
            if ($obj->getCategory()) {
                $sCategory = ' - ' . $obj->getCategory()->getAcronym();
                $iCategoryId = $obj->getCategory()->getId();
            } else {
                $sCategory = '';
                $iCategoryId = 0;
            }
            $rows[] = array(
                'id' => $obj->getId(),
                'title' => $obj->getCustomer()->getName() . ', ' . $obj->getCustomer()->getFirstname() . $sCategory,
                'start' => $obj->getStart()->format('Y-m-d H:i:s'),
                'end' => $obj->getEnd()->format('Y-m-d H:i:s'),
                'className' => $this->GetStatus($obj),
                'categoryid' => $iCategoryId
            );
        }

        $serializedEntity = $this->container->get('serializer')->serialize($rows, 'json');
        $response = new Response($serializedEntity);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     *
     * @param type $entBooking
     */
    private function GetStatus($entBooking) {
        $DateTimeNow = new \DateTime("now");
        $sReturnLabel = 'label-primary';

        if ($DateTimeNow > $entBooking->getEnd()) {
            $sReturnLabel = 'label-danger';
        }
        if ($entBooking->getCancellation() == 1) {
            $sReturnLabel = 'label-warning';
        }
        if ($entBooking->getInvoiceId() > 0) {
            $sReturnLabel = 'label-success';
        }

        return $sReturnLabel;
    }

    /**
     * Add a Reservation to the Calendar
     */
    public function addReservationAction() {
        $request = $this->get('request');
        $data = $request->request->all();

        $BookingModel = new BookingModel($this->getDoctrine()->getManager());
        $booking = $BookingModel->addReservation($data);

        $serializedEntity = $this->container->get('serializer')->serialize($booking->getId(), 'json');
        $response = new Response($serializedEntity);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Update a reservation to the calendar
     *
     */
    public function updateReservationAction() {
        try {
            $request = $this->get('request');
            $data = $request->request->all();

            $em = $this->getDoctrine()->getManager();
            $booking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($data["id"]);

            $booking->setStart(new \DateTime($data["start"]));
            $booking->setEnd(new \DateTime($data["end"]));

            if (isset($data["title"])) {
                $booking->setTitle($data["title"]);
                $customer = $em->getRepository('pspiessLetsplayBundle:Customer')->find($data["customerid"]);
                $category = $em->getRepository('pspiessLetsplayBundle:Category')->find($data["categoryid"]);
                $booking->setCustomer($customer);
                $booking->setCategory($category);
            }

            $em->persist($booking);
            $em->flush();

            $serializedEntity = $this->container->get('serializer')->serialize('', 'json');
            $response = new Response($serializedEntity);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } catch (\Exception $e) {
            $e;
        }
    }

    /**
     * Cancel a Reservation to the Calendar
     */
    public function cancelReservationAction() {
        $request = $this->get('request');
        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($data["id"]);

        $booking->setCancellation(1);

        $em->persist($booking);
        $em->flush();

        $serializedEntity = $this->container->get('serializer')->serialize('', 'json');
        $response = new Response($serializedEntity);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * delete a reservation
     */
    public function deleteReservationAction() {
        $request = $this->get('request');
        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();

        $booking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($data["id"]);

        if ((int)$data["serial"] == 1) {
            $this->deleteSerialBooking($booking);
        } else {
            $em->remove($booking);
            $em->flush();
        }

        $serializedEntity = $this->container->get('serializer')->serialize($booking->getId(), 'json');
        $response = new Response($serializedEntity);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * delete serial reservation
     *
     * @param Booking $booking
     */
    public function deleteSerialBooking(Booking $booking) {
        $em = $this->getDoctrine()->getManager();

        $bookingsSerial = $em->getRepository('pspiessLetsplayBundle:Booking')->getBookingSerial(
            $booking->getField()->getId(),
            $booking->getCustomer()->getId(),
            $booking->getStart(),
            $booking->getEnd());

        foreach ($bookingsSerial as $entity) {
            $em->remove($entity);
        }

        $em->flush();
    }

    /**
     * check if reservation is serial
     */
    public function checkBookingSerialAction() {
        $request = $this->get('request');
        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $records = array('records' => null);

        $booking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($data["id"]);
        $bookingsSerial = $em->getRepository('pspiessLetsplayBundle:Booking')->getBookingSerial(
            $booking->getField()->getId(),
            $booking->getCustomer()->getId(),
            $booking->getStart(),
            $booking->getEnd());

        $records['records'] = count($bookingsSerial);

        $response = new Response($this->container->get('serializer')->serialize($records, 'json'));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Creates a new Booking entity.
     * @Route("/", name="booking_create")
     */
    public function createAction(Request $request) {
        $entity = new Booking();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_letsplay_booking_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Booking entity.
     *
     * @param Booking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Booking $entity) {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_booking_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Booking entity.
     *
     * @Route("/new", name="booking_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Booking();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Booking entity.
     *
     * @Route("/{id}", name="booking_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Booking entity.
     *
     * @Route("/{id}/edit", name="booking_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Booking entity.
     *
     * @param Booking $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Booking $entity) {
        $form = $this->createForm(new BookingType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_booking_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Booking entity.
     *
     * @Route("/{id}", name="booking_update")
     * @Method("PUT")
     * @Template("pspiessLetsplayBundle:Booking:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Booking')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Booking entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_letsplay_booking_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Booking entity.
     *
     * @Route("/{id}", name="booking_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessLetsplayBundle:Booking')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Booking entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pspiess_letsplay_booking'));
    }

    /**
     * Creates a form to delete a Booking entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pspiess_letsplay_booking_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm();
    }

}
