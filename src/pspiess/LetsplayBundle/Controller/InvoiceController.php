<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Invoice;
use pspiess\LetsplayBundle\Entity\Invoicepos;
use pspiess\LetsplayBundle\Entity\Payoffice;
use pspiess\LetsplayBundle\Entity\Payofficepos;
use pspiess\LetsplayBundle\Form\InvoiceType;

/**
 * Invoice controller.
 *
 * @Route("/invoice")
 */
class InvoiceController extends Controller {

    /**
     * Lists all Invoice entities.
     *
     * @Route("/", name="invoice")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessLetsplayBundle:Invoice')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Invoice entity.
     *
     * @Route("/", name="invoice_create")
     * @Method("POST")
     * @Template("pspiessLetsplayBundle:Invoice:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Invoice();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $entity->setInvoiceNumber($em->getRepository('pspiessLetsplayBundle:Invoice')->getNextInviceNumber());
            foreach ($entity->getInvoicepos() as $entInvoice) {
                $entity->addInvoicepos($entInvoice);
            }

            $em->persist($entity);
            $em->flush();

            $entBooking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($entity->getBookingId());
            $entBooking->setInvoiceId($entity->getId());

            $em->persist($entBooking);
            $em->flush();

            $entPayofficepos = new Payofficepos();
            $entPayofficepos->setAmount($entity->getPaidPrice());
            $entPayofficepos->setDate(new \DateTime);
            $entPayofficepos->setInvoice($entity);

            //Todo need to check for the user
            $entPayoffice = $em->getRepository('pspiessLetsplayBundle:Payoffice')->getOnePayoffice();
            if ($entPayoffice == null) {
                $entPayoffice = new Payoffice();
                $entPayoffice->setOpened(new \DateTime);
            }
            $entPayoffice->addPayofficepos($entPayofficepos);
            $em->persist($entPayoffice);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pspiess_letsplay_invoice_show', array('id' => $entity->getId())));
    }

    /**
     * Creates a form to create a Invoice entity.
     *
     * @param Invoice $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Invoice $entity) {
        $form = $this->createForm(new InvoiceType(1), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_invoice_create'),
            'method' => 'POST'
        ));

        $form->add('submit', 'submit', array('label' => 'Abrechnen'));

        return $form;
    }

    /**
     * Displays a form to create a new Invoice entity.
     *
     * @Route("/new/{id}", name="invoice_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entBooking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($id);
        $entInvoice = new Invoice();

        $entInvoice->setBookingId($entBooking->Getid()); //ToDo
        $entInvoice->setInvoiceNumber($em->getRepository('pspiessLetsplayBundle:Invoice')->getNextInviceNumber()); //ToDo
        $entInvoice->setTaxNumber("117/5079/1565"); //ToDo 
        $entInvoice->setCustomerNumber($entBooking->getCustomer()->getCustomernr()); //ToDo 
        $entInvoice->setPayment("Cash"); //ToDo 
        $entInvoice->setDate(new \DateTime("now"));
        $entInvoice->setCompanyStreet('Im Witschen 30');
        $entInvoice->setCompanyZip('47807');
        $entInvoice->setCompanyLocation('Krefeld');
        $entInvoice->setCompanyCountry('Deutschland');
        $entInvoice->setCompanyPhone('02151 1504410');
        $entInvoice->setNote('Gespielt wurde auf Platz: ' . $entBooking->getField()->getFieldnr() . ' - ' . $entBooking->getField()->getType());

        $entInvoice->setCustomerFirstname($entBooking->getCustomer()->getFirstname());
        $entInvoice->setCustomerName($entBooking->getCustomer()->getName());
        $entInvoice->setCustomerStreet($entBooking->getCustomer()->getStreet());
        $entInvoice->setCustomerZip($entBooking->getCustomer()->getZip());
        $entInvoice->setCustomerLocation($entBooking->getCustomer()->getLocation());
        $entInvoice->setCustomerCountry($entBooking->getCustomer()->getCountry());
        $entInvoice->setCustomerPhone($entBooking->getCustomer()->getPhone());

        $dDateStart = $entBooking->getStart();
        $dDateEnd = $entBooking->getEnd();

        $dDate = $dDateStart;
        $decTotalTime = 0;
        $decTotalPrice = 0.0;
        $decDiscount = 0.0;

        for ($dDate = $dDateStart; $dDate < $dDateEnd; $dDate->modify("+30 minutes")) {
            $entInvoicepos = new Invoicepos();

            $entInvoicepos->setPrice(20);
            $entInvoicepos->setProduct('Spielzeit - 30 Minuten');
            $entInvoicepos->setDescription("Kein Preis hinterlegt");

            $tempDate = new \DateTime($dDate->format('H:i:s'));
            $tempDate->modify("+30 minutes");
                    
            foreach ($entBooking->getField()->GetPrice() as $obj) {
                if ($dDate->format('H:i:s') >= $obj->GetTimefrom()->format('H:i:s') && $dDate->format('H:i:s') <= $obj->GetTimeto()->format('H:i:s') && ((int) $dDate->format('N')) - 1 >= $obj->getWeekDayFrom() && ((int) $dDate->format('N')) - 1 <= $obj->getWeekDayto()) {
                    $entInvoicepos->setPrice($obj->GetPrice() / 2);
                    $entInvoicepos->setProduct('Spielzeit - 30 Minuten');
                    $entInvoicepos->setDescription($dDate->format('H:i') . ' - ' . $tempDate->format('H:i') . ', ' . $obj->GetIndentifier());
                }
            }
            
            $decDiscount =  $decDiscount + $this->GetDiscount($entBooking, $decTotalTime);
            $decTotalPrice = (float) $entInvoicepos->getPrice() + $decTotalPrice;

            $decTotalTime++;
            $entInvoicepos->setPos($decTotalTime); //Position
            $entInvoicepos->setQuantity(1);
            $entInvoicepos->setTotalPrice($entInvoicepos->getQuantity() * $entInvoicepos->getPrice());
            $entInvoicepos->setDiscount(0);
            $entInvoicepos->setTax(0);
            $entInvoice->addInvoicepos($entInvoicepos);
        }
        
        //GetDiscount
        if ($decDiscount < 0.0) {
            $entInvoicepos = new Invoicepos();
            $entInvoicepos->setPrice($entBooking->getCustomer()->getDiscount() * (- 1));
            $entInvoicepos->setProduct('Rabatt');
            $entInvoicepos->setDescription('Sofortrabatt');
            $entInvoicepos->setPos($decTotalTime + 1); //Position
            $entInvoicepos->setQuantity(1);
            $entInvoicepos->setTotalPrice($decDiscount);
            $entInvoicepos->setDiscount($decDiscount);
            $entInvoicepos->setTax(0);
            $entInvoice->addInvoicepos($entInvoicepos);
            $decTotalPrice = (float) $decTotalPrice + $decDiscount;
        }
        
        $entInvoice->setTotalPrice($decTotalPrice);
        $entInvoice->setTotalPricenet($decTotalPrice / (19 / 100 + 1));
        $entInvoice->setTax($entInvoice->getTotalPrice() - $entInvoice->getTotalPricenet());
        $entInvoice->setPaidPrice($decTotalPrice);

//        $em->persist($entInvoice);
//        $em->flush($entInvoice); // ohne flush gibt es keine verknüpfung in der Form... warum?
        $form = $this->createCreateForm($entInvoice);

        return array(
            'entity' => $entInvoice,
            'data' => 'TEST',
            'form' => $form->createView(),
        );
    }
    
    private function GetDiscount (\pspiess\LetsplayBundle\Entity\Booking $entBooking, $iPosition) {
        $dTimeDiscountFrom = new \DateTime('now');
        $dTimeDiscountTo = new \DateTime('now');
        $dTimeDiscountFrom->setTime(17, 00);
        $dTimeDiscountTo->setTime(22, 00);
        
        if ($entBooking->getCustomer()->getDiscount() > 0 
        && $entBooking->getStart()->format('H:i:s') >= $dTimeDiscountFrom->format('H:i:s') && $entBooking->getStart()->format('H:i:s') < $dTimeDiscountTo->format('H:i:s') 
        && ((int) $entBooking->getStart()->format('N')) - 1 >= 0 && ((int) $entBooking->getStart()->format('N')) - 1 <= 4) {
            return $entBooking->getCustomer()->getDiscount() * (- 1);
        }
        return 0.0;
    }

    /**
     * Finds and displays a Invoice entity.
     *
     * @Route("/{id}", name="invoice_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoice entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);
        $customer = $em->getRepository('pspiessLetsplayBundle:Customer')->findOneByCustomernr($entity->GetCustomerNumber());

        return array(
            'entity' => $entity,
            'customer' => $customer,
//            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Invoice entity.
     *
     * @Route("/{id}/edit", name="invoice_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoice entity.');
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
     * Creates a form to edit a Invoice entity.
     *
     * @param Invoice $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Invoice $entity) {
        $form = $this->createForm(new InvoiceType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_invoice_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Invoice entity.
     *
     * @Route("/{id}", name="invoice_update")
     * @Method("PUT")
     * @Template("pspiessLetsplayBundle:Invoice:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoice entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('invoice_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Invoice entity.
     *
     * @Route("/{id}", name="invoice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessLetsplayBundle:Invoice')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Invoice entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('invoice'));
    }

    /**
     * Creates a form to delete a Invoice entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('invoice_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
