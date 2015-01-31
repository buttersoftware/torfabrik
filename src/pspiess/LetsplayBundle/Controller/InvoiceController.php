<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Invoice;
use pspiess\LetsplayBundle\Entity\Invoicepos;
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
     * Lists all Invoice entities.
     *
     */
    public function GetPreInvoice($iBooking_id) {
        $em = $this->getDoctrine()->getManager();
        $booking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($iBooking_id);

        return array(
            'entities' => $booking,
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
//            $query = $em->createQuery(
//                'SELECT i
//                FROM pspiessLetsplayBundle:Invoice i
//                WHERE i.invoiceNumber < :invoiceNumber
//                ORDER BY i.invoiceNumber ASC'
//            )->setParameter('invoiceNumber', '99999999999');
//            
//            $entInvoice = $query->getResult();
//            

            foreach ($entity->getInvoicepos() as $entInvoice) {
                $entity->addInvoicepos($entInvoice);
            }

            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('pspiess_letsplay_invoice_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
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
//        echo '<javascript>console.log("drin");</javascript>';
        $em = $this->getDoctrine()->getManager();
        $entBooking = $em->getRepository('pspiessLetsplayBundle:Booking')->find($id);
        $entInvoice = new Invoice();
        
        $entInvoice->setInvoiceNumber($em->getRepository('pspiessLetsplayBundle:Invoice')->getNextInviceNumber()); //ToDo
        $entInvoice->setTaxNumber("123/222/9087"); //ToDo 
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

        for ($dDate = $dDateStart; $dDate < $dDateEnd; $dDate->modify("+30 minutes")) {
            $entInvoicepos = new Invoicepos();

            //Standart Preis
            $entInvoicepos->setPrice(20);
            $entInvoicepos->setProduct('Spielzeit - 30 Minuten');
            $entInvoicepos->setDescription("Kein Preis hinterlegt");

            foreach ($entBooking->getField()->GetPrice() as $obj) {
                if ($dDate->format('H:i:s') >= $obj->GetTimefrom()->format('H:i:s') && $dDate->format('H:i:s') <= $obj->GetTimeto()->format('H:i:s') && ((int) $dDate->format('N')) - 1 >= $obj->getWeekDayFrom() && ((int) $dDate->format('N')) - 1 <= $obj->getWeekDayto()) {
                    $entInvoicepos->setPrice($obj->GetPrice() / 2);
                    $entInvoicepos->setProduct('Spielzeit - 30 Minuten');
                    $entInvoicepos->setDescription($dDate->format('H:i:s') . ' - ' . $obj->GetIndentifier());
                }
            }

            $decTotalPrice = (float) $entInvoicepos->getPrice() + $decTotalPrice;

            $decTotalTime++;
//            echo $dDate->format('H:i:s') .'>='. $obj->GetTimefrom()->format('H:i:s') .'&&'. $dDate->format('H:i:s') .'<='. $obj->GetTimeto()->format('H:i:s').'<br>';
            $entInvoicepos->setPos($decTotalTime); //Position
            $entInvoicepos->setQuantity(1);
            $entInvoicepos->setTotalPrice($entInvoicepos->getQuantity() * $entInvoicepos->getPrice());
            $entInvoicepos->setDiscount(0);
            $entInvoicepos->setTax(0);
            $entInvoice->addInvoicepos($entInvoicepos);
        }

        if ($entBooking->getCustomer()->getDiscount() > 0) {
            $entInvoicepos = new Invoicepos();
            $entInvoicepos->setPrice($entBooking->getCustomer()->getDiscount() * (- 1));
            $entInvoicepos->setProduct('Rabatt');
            $entInvoicepos->setDescription('Sofortrabatt');
            $entInvoicepos->setPos($decTotalTime + 1); //Position
            $entInvoicepos->setQuantity(1);
            $entInvoicepos->setTotalPrice($entInvoicepos->getQuantity() * $entInvoicepos->getPrice());
            $entInvoicepos->setDiscount(0);
            $entInvoicepos->setTax(0);
            $decTotalPrice = (float) $entInvoicepos->getPrice() + $decTotalPrice;
            $entInvoice->addInvoicepos($entInvoicepos);
        }

//        echo ($decTotalTime / 2). ' Stunden gespielt';
//        echo (string)$decTotalPrice. '€ Gesamtpreis';

        $entInvoice->setTotalPrice($decTotalPrice);
        $entInvoice->setTotalPricenet($decTotalPrice / (19 / 100 + 1));
        $entInvoice->setTax($entInvoice->getTotalPrice() - $entInvoice->getTotalPricenet());
        $entInvoice->setPaidPrice($decTotalPrice);

        $em->persist($entInvoice);
        //$em->flush($entInvoice); // ohne flusch gibt es keine verknüpfung in der Form... warum?
        $form = $this->createCreateForm($entInvoice);
//        $form = $this->createEditForm($entInvoice);
        return array(
            'entity' => $entInvoice,
            'form' => $form->createView(),
        );
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

//        $deleteForm = $this->createDeleteForm($id);
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
