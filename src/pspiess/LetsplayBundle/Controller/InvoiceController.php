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
class InvoiceController extends Controller
{

    /**
     * Lists all Invoice entities.
     *
     * @Route("/", name="invoice")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
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
    public function GetPreInvoice($iBooking_id)
    {
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
    public function createAction(Request $request)
    {
        $entity = new Invoice();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            //return $this->redirect($this->generateUrl('invoice_show', array('id' => $entity->getId())));
            return $this->redirect($this->generateUrl('pspiess_letsplay_invoice_update', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Invoice entity.
     *
     * @param Invoice $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Invoice $entity)
    {
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
     * @Route("/new", name="invoice_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $em = $this->getDoctrine()->getManager();
        $entBooking = $em->getRepository('pspiessLetsplayBundle:Booking')->find(123);
        echo $entBooking->getStart();
        
        $entInvoice = new Invoice();
        $entInvoicepos = new Invoicepos();
        $entInvoicepos1 = new Invoicepos();
        
        
        $entInvoice->setInvoiceNumber(1); //ToDo 
        $entInvoice->setCustomerNumber(1); //ToDo 
        $entInvoice->setPayment("Cash"); //ToDo 
        $entInvoice->setDate(new \DateTime("now"));
        $entInvoice->setCompanyStreet('Im Witschen 30');
        $entInvoice->setCompanyZip('47807');
        $entInvoice->setCompanyLocation('Krefeld');
        $entInvoice->setCompanyCountry('Deutschland');
        $entInvoice->setCompanyPhone('02151 1504410');
        $entInvoice->setNote('Bemerkung');
        
        $entInvoice->setCustomerStreet($entBooking->getCustomer()->getStreet());
        $entInvoice->setCustomerZip($entBooking->getCustomer()->getZip());
        $entInvoice->setCustomerLocation($entBooking->getCustomer()->getLocation());
        $entInvoice->setCustomerCountry($entBooking->getCustomer()->getCountry());
        $entInvoice->setCustomerPhone($entBooking->getCustomer()->getPhone());
        
//        $em->persist($entInvoice);
        
        $entInvoicepos->setPos(1);
        $entInvoicepos->setPrice(9.99);
        $entInvoicepos->setProduct('30 Minuten');
        $entInvoicepos->setDescription('Normaltariff');
        $entInvoicepos->setQuantity(1);
        $entInvoicepos->setTotalPrice($entInvoicepos->getQuantity() * $entInvoicepos->getPrice());
        $entInvoicepos->setDiscount(0);
        $entInvoicepos->setTax(0);
//        $entInvoicepos->setInvoice($entInvoice);
//        $em->persist($entInvoicepos);
        
        $entInvoicepos1->setPos(2);
        $entInvoicepos1->setPrice(19.99);
        $entInvoicepos1->setProduct('45 Minuten');
        $entInvoicepos1->setDescription('Normaltariff');
        $entInvoicepos1->setQuantity(1);
        $entInvoicepos1->setDiscount(0);
        $entInvoicepos1->setTax(0);
        $entInvoicepos1->setTotalPrice($entInvoicepos1->getQuantity() * $entInvoicepos1->getPrice());
//        $entInvoicepos1->setInvoice($entInvoice);
//        $em->persist($entInvoicepos1);
        
        
        
        $entInvoice->addInvoicepos($entInvoicepos);
        $entInvoice->addInvoicepos($entInvoicepos1);
        
        $em->persist($entInvoice);
//        $em->flush($entInvoice);
        $form   = $this->createCreateForm($entInvoice);
//        $form = $this->createEditForm($entInvoice);
        return array(
            'entity' => $entInvoice,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Invoice entity.
     *
     * @Route("/{id}", name="invoice_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoice entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Invoice entity.
     *
     * @Route("/{id}/edit", name="invoice_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoice')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoice entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
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
    private function createEditForm(Invoice $entity)
    {
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
    public function updateAction(Request $request, $id)
    {
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
            'entity'      => $entity,
            'form'   => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Invoice entity.
     *
     * @Route("/{id}", name="invoice_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
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
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoice_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
