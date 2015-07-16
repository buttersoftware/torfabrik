<?php

namespace pspiess\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\BlogBundle\Entity\Subcategory;
use pspiess\BlogBundle\Form\SubcategoryType;

/**
 * Subcategory controller.
 *
 * @Route("/pspiess_blog_subcategory")
 */
class SubcategoryController extends Controller {

    /**
     * Lists all Subcategory entities.
     *
     * @Route("/", name="pspiess_blog_subcategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request) {        
        $paginator = $this->get('knp_paginator');
        
        return array(
            'entities' => $paginator->paginate(
                    $this->getDoctrine()->getRepository('pspiessBlogBundle:Subcategory')->GetSubcategoryByName($request->query->get('keyword', ''))
                    , $request->query->get('page', 1), 50),
            'keyword' => $request->query->get('keyword', 'Bitte hier Suchbergriff eingeben...'),
        );
    }

    /**
     * Creates a new Subcategory entity.
     *
     * @Route("/", name="pspiess_blog_subcategory_create")
     * @Method("POST")
     * @Template("pspiessBlogBundle:Subcategory:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Subcategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_blog_subcategory_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Subcategory entity.
     *
     * @param Subcategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Subcategory $entity) {
        $form = $this->createForm(new SubcategoryType(), $entity, array(
            'action' => $this->generateUrl('pspiess_blog_subcategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Erstellen'));

        return $form;
    }

    /**
     * Displays a form to create a new Subcategory entity.
     *
     * @Route("/new", name="pspiess_blog_subcategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Subcategory();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Subcategory entity.
     *
     * @Route("/{id}", name="pspiess_blog_subcategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Subcategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Subcategory entity.
     *
     * @Route("/{id}/edit", name="pspiess_blog_subcategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Subcategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategory entity.');
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
     * Creates a form to edit a Subcategory entity.
     *
     * @param Subcategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Subcategory $entity) {
        $form = $this->createForm(new SubcategoryType(), $entity, array(
            'action' => $this->generateUrl('pspiess_blog_subcategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Ändern'));

        return $form;
    }

    /**
     * Edits an existing Subcategory entity.
     *
     * @Route("/{id}", name="pspiess_blog_subcategory_update")
     * @Method("PUT")
     * @Template("pspiessBlogBundle:Subcategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Subcategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Subcategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_blog_subcategory_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Subcategory entity.
     *
     * @Route("/{id}", name="pspiess_blog_subcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessBlogBundle:Subcategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Subcategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pspiess_blog_subcategory'));
    }

    /**
     * Creates a form to delete a Subcategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('pspiess_blog_subcategory_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Löschen'))
                        ->getForm()
        ;
    }

}
