<?php

namespace pspiess\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\BlogBundle\Entity\Maincategory;
use pspiess\BlogBundle\Form\MaincategoryType;

/**
 * Maincategory controller.
 *
 * @Route("/maincategory")
 */
class MaincategoryController extends Controller
{

    /**
     * Lists all Maincategory entities.
     *
     * @Route("/", name="maincategory")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $paginator = $this->get('knp_paginator');
        
        return array(
            'entities' => $paginator->paginate(
                    $this->getDoctrine()->getRepository('pspiessBlogBundle:Maincategory')->GetMaincategoryByName($request->query->get('keyword', ''))
                    , $request->query->get('page', 1), 50),
            'keyword' => $request->query->get('keyword', 'Bitte hier Suchbergriff eingeben...'),
        );
    }
    /**
     * Creates a new Maincategory entity.
     *
     * @Route("/", name="pspiess_pspiess_blog_maincategory_create")
     * @Method("POST")
     * @Template("pspiessBlogBundle:Maincategory:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Maincategory();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_blog_maincategory_update', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Maincategory entity.
     *
     * @param Maincategory $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Maincategory $entity)
    {
        $form = $this->createForm(new MaincategoryType(), $entity, array(
            'action' => $this->generateUrl('pspiess_blog_maincategory_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Erstellen'));

        return $form;
    }

    /**
     * Displays a form to create a new Maincategory entity.
     *
     * @Route("/new", name="maincategory_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Maincategory();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Maincategory entity.
     *
     * @Route("/{id}", name="maincategory_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Maincategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maincategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Maincategory entity.
     *
     * @Route("/{id}/edit", name="maincategory_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Maincategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maincategory entity.');
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
    * Creates a form to edit a Maincategory entity.
    *
    * @param Maincategory $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Maincategory $entity)
    {
        $form = $this->createForm(new MaincategoryType(), $entity, array(
            'action' => $this->generateUrl('pspiess_blog_maincategory_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Anpassen'));

        return $form;
    }
    /**
     * Edits an existing Maincategory entity.
     *
     * @Route("/{id}", name="pspiess_blog_maincategory_update")
     * @Method("PUT")
     * @Template("pspiessBlogBundle:Maincategory:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Maincategory')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Maincategory entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_blog_maincategory_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Maincategory entity.
     *
     * @Route("/{id}", name="pspiess_blog_maincategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessBlogBundle:Maincategory')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Maincategory entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pspiess_blog_maincategory'));
    }

    /**
     * Creates a form to delete a Maincategory entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pspiess_blog_maincategory_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen'))
            ->getForm()
        ;
    }
}
