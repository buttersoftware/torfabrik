<?php

namespace pspiess\BlogBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\BlogBundle\Entity\Blog;
use pspiess\BlogBundle\Form\BlogType;

/**
 * Blog controller.
 *
 * @Route("/pspiess_blog_blog")
 */
class BlogController extends Controller
{

    /**
     * Lists all Blog entities.
     *
     * @Route("/", name="pspiess_blog_blog")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $paginator = $this->get('knp_paginator');
        
        return array(
            'entities' => $paginator->paginate(
                    $this->getDoctrine()->getRepository('pspiessBlogBundle:Blog')->GetBlogByName($request->query->get('keyword', ''))
                    , $request->query->get('page', 1), 50),
            'keyword' => $request->query->get('keyword', 'Bitte hier Suchbergriff eingeben...'),
        );
    }
    /**
     * Creates a new Blog entity.
     *
     * @Route("/", name="pspiess_blog_blog_create")
     * @Method("POST")
     * @Template("pspiessBlogBundle:Blog:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Blog();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_blog_blog_edit', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Blog entity.
     *
     * @param Blog $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Blog $entity)
    {
        $form = $this->createForm(new BlogType(), $entity, array(
            'action' => $this->generateUrl('pspiess_blog_blog_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Speichern'));

        return $form;
    }

    /**
     * Displays a form to create a new Blog entity.
     *
     * @Route("/new", name="pspiess_blog_blog_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Blog();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Blog entity.
     *
     * @Route("/{id}", name="pspiess_blog_blog_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Blog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Blog entity.
     *
     * @Route("/{id}/edit", name="pspiess_blog_blog_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Blog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blog entity.');
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
    * Creates a form to edit a Blog entity.
    *
    * @param Blog $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Blog $entity)
    {
        $form = $this->createForm(new BlogType(), $entity, array(
            'action' => $this->generateUrl('pspiess_blog_blog_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Speichern'));

        return $form;
    }
    /**
     * Edits an existing Blog entity.
     *
     * @Route("/{id}", name="pspiess_blog_blog_update")
     * @Method("PUT")
     * @Template("pspiessBlogBundle:Blog:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessBlogBundle:Blog')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Blog entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_blog_blog_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Blog entity.
     *
     * @Route("/{id}", name="pspiess_blog_blog_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessBlogBundle:Blog')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Blog entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pspiess_blog_blog'));
    }

    /**
     * Creates a form to delete a Blog entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pspiess_blog_blog_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Löschen'))
            ->getForm()
        ;
    }
}
