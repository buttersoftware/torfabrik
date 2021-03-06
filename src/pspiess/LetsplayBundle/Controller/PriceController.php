<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Price;
use pspiess\LetsplayBundle\Form\PriceType;

/**
 * Price controller.
 *
 * @Route("/price")
 */
class PriceController extends Controller {

    /**
     * Lists all Price entities.
     *
     * @Route("/", name="price")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessLetsplayBundle:Price')->findAll();

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
     * Creates a new Price entity.
     *
     * @Route("/", name="price_create")
     * @Method("POST")
     * @Template("pspiessLetsplayBundle:Price:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Price();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_letsplay_price_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Price entity.
     *
     * @param Price $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Price $entity) {
        $form = $this->createForm(new PriceType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_price_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'anlegen', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Price entity.
     *
     * @Route("/new", name="price_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Price();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Price entity.
     *
     * @Route("/{id}", name="price_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Price entity.
     *
     * @Route("/{id}/edit", name="price_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
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
     * Creates a form to edit a Price entity.
     *
     * @param Price $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Price $entity) {
        $form = $this->createForm(new PriceType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_price_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'ändern', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Edits an existing Price entity.
     *
     * @Route("/{id}", name="price_update")
     * @Method("PUT")
     * @Template("pspiessLetsplayBundle:Price:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Price')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Price entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_letsplay_price_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Price entity.
     *
     * @Route("/{id}", name="price_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessLetsplayBundle:Price')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Price entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pspiess_letsplay_price'));
    }

    /**
     * Creates a form to delete a Price entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('pspiess_letsplay_price_delete', array('id' => $id)))
                        ->setMethod('DELETE')
//                        ->add('submit', 'submit', array('label' => 'löschen', 'attr' => array('class' => 'btn btn-danger')))
                        ->add('id', 'hidden')
                
//            ->add('indentifier', 'text', array('label' => 'Bezeichnung', 'attr' => array('class' => '')))
                        ->getForm()
        ;
        
//            $deleteForm = $this->createFormBuilder(['id' => 1])
//        ->add('id', 'hidden')
//        ->getForm();
    }

}
