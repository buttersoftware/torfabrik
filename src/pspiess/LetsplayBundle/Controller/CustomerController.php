<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Customer;
use pspiess\LetsplayBundle\Form\CustomerType;
use Symfony\Component\HttpFoundation\Response;


/**
 * Customer controller.
 *
 * @Route("/customer")
 */
class CustomerController extends Controller {

    /**
     * Lists all Customer entities.
     *
     * @Route("/", name="customer")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessLetsplayBundle:Customer')->findAll();

        $deleteForms = array();

        foreach ($entities as $entity) {
            $deleteForms[$entity->getId()] = $this->createDeleteForm($entity->getId())->createView();
        }

        return array(
            'entities' => $entities,
            'deleteForms' => $deleteForms,
        );
    }

    /**
     * Lists all customer entities for Calendar.
     *
     * @Route("/", name="customer_getAllCalendar")
     * @Method("GET")
     * @Template()
     */
    public function getAllCustomerAction() {
        $em = $this->getDoctrine()->getManager();

        $customer = $em->getRepository('pspiessLetsplayBundle:Customer')->findAll();

        $rows = array();
        foreach ($customer as $obj) {
            $rows[] = array('label' => $obj->getName().', '. $obj->getFirstname(), 
                'value' => $obj->getId());
        }

        $serializedEntity = $this->container->get('serializer')->serialize($rows, 'json');
        $response = new Response($serializedEntity);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * Creates a new Customer entity.
     *
     * @Route("/", name="customer_create")
     * @Method("POST")
     * @Template("pspiessLetsplayBundle:Customer:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Customer();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_letsplay_customer_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Customer entity.
     *
     * @param Customer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Customer $entity) {
        $form = $this->createForm(new CustomerType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_customer_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'anlegen', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Customer entity.
     *
     * @Route("/new", name="customer_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Customer();
        $form = $this->createCreateForm($entity);
        
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Customer entity.
     *
     * @Route("/{id}", name="customer_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Customer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Customer entity.
     *
     * @Route("/{id}/edit", name="customer_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Customer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
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
     * Creates a form to edit a Customer entity.
     *
     * @param Customer $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Customer $entity) {
        $form = $this->createForm(new CustomerType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_customer_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Customer entity.
     *
     * @Route("/{id}", name="customer_update")
     * @Method("PUT")
     * @Template("pspiessLetsplayBundle:Customer:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Customer')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Customer entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_letsplay_customer_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Customer entity.
     *
     * @Route("/{id}", name="customer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessLetsplayBundle:Customer')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Customer entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pspiess_letsplay_customer'));
    }

    /**
     * Creates a form to delete a Customer entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('pspiess_letsplay_customer_delete', array('id' => $id)))
                        ->setMethod('DELETE')
//                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->add('id', 'hidden')
                        ->getForm()
        ;
    }

}
