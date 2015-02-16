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

        $entities = $em->getRepository('pspiessLetsplayBundle:Customer')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all Booking entities for Calendar.
     * @Method("GET")
     */
    public function showCalendarAction($iField = 0) {
        $em = $this->getDoctrine()->getManager();

        $entBooking = $em->getRepository('pspiessLetsplayBundle:Booking')->findAll();

        $rows = array();
        foreach ($entBooking as $obj) {
            $rows[] = array(
                'id' => $obj->getId(),
                'title' => $obj->getCustomer()->getName() . ', ' . $obj->getCustomer()->getFirstname(),
                'start' => $obj->getStart()->format('Y-m-d H:i:s'),
                'end' => $obj->getEnd()->format('Y-m-d H:i:s'),
                'className' => $this->GetStatus($obj),
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
        $em = $this->getDoctrine()->getManager();
        $request = $this->get('request');
        $data = $request->request->all();
        
        $sSerial = $this->GetSerialOption($data['serial']);
        $dSerialDate = new \DateTime($data['serial_date']);
        $dStartDate = new \DateTime($data['start']);
        $dEndDate = new \DateTime($data['end']);
        
        $customer = $em->getRepository('pspiessLetsplayBundle:Customer')->find($data["customerid"]);
        $field = $em->getRepository('pspiessLetsplayBundle:Field')->find($data["fieldid"]);
        
        for ($dDate = $dStartDate; $dDate < $dSerialDate; $dDate->modify($sSerial)) {
            $booking = new Booking();

            $booking->setCustomer($customer);
            $booking->setField($field);
            $booking->setTitle($data["title"]);
            $booking->setStart($dStartDate);
            $booking->setEnd($dEndDate);

            $dEndDate->modify($sSerial);
        }
        
        $em->persist($booking);
        $em->flush();

        $serializedEntity = $this->container->get('serializer')->serialize($booking->getId(), 'json');
        $response = new Response($serializedEntity);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    private function GetSerialOption($data) {
        switch ($data) {
            case 0:
                $sSerial = '+1 day';
                break;
            case 1:
                $sSerial = '+7 day';
                break;
            case 2:
                $sSerial = '+14 day';
                break;
            case 3:
                $sSerial = '+1 month';
                break;
        }
        return $sSerial;
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

            if (isset($data["customerid"])) {
                $booking->setTitle($data["title"]);
                $customer = $em->getRepository('pspiessLetsplayBundle:Customer')->find($data["customerid"]);
                $booking->setCustomer($customer);
            }

            $em->persist($booking);
            $em->flush();

            $serializedEntity = $this->container->get('serializer')->serialize($booking, 'json');
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

        $serializedEntity = $this->container->get('serializer')->serialize($booking, 'json');
        $response = new Response($serializedEntity);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Delete a Reservation
     */
    public function deleteReservationAction() {
        $request = $this->get('request');
        $data = $request->request->all();

        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($data["id"]);

        $em->remove($booking);
        $em->flush();

        $serializedEntity = $this->container->get('serializer')->serialize($booking, 'json');
        $response = new Response($serializedEntity);
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
                        ->getForm()
        ;
    }

}
