<?php

namespace pspiess\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\ContentBundle\Entity\Pictures;
use pspiess\ContentBundle\Form\PicturesType;

/**
 * Pictures controller.
 *
 * @Route("/pictures")
 */
class PicturesController extends Controller {

    /**
     * Lists all Pictures entities.
     *
     * @Route("/", name="pictures")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessContentBundle:Pictures')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Pictures entity.
     *
     * @Route("/", name="pictures_create")
     * @Method("POST")
     * @Template("pspiessContentBundle:Pictures:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Pictures();

        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pictures', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Pictures entity.
     *
     * @param Pictures $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pictures $entity) {
        $form = $this->createForm(new PicturesType(), $entity, array(
            'action' => $this->generateUrl('pictures_create'),
            'method' => 'POST',
        ));

        $form->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-success')));


        return $form;
    }

    /**
     * Displays a form to create a new Pictures entity.
     *
     * @Route("/new", name="pictures_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Pictures();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pictures entity.
     *
     * @Route("/{id}", name="pictures_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Pictures')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pictures entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pictures entity.
     *
     * @Route("/{id}/edit", name="pictures_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Pictures')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pictures entity.');
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
     * Creates a form to edit a Pictures entity.
     *
     * @param Pictures $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Pictures $entity) {
        $form = $this->createForm(new PicturesType(), $entity, array(
            'action' => $this->generateUrl('pictures_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-success'), 'label' => 'ändern'));

        return $form;
    }

    /**
     * Edits an existing Pictures entity.
     *
     * @Route("/{id}", name="pictures_update")
     * @Method("PUT")
     * @Template("pspiessContentBundle:Pictures:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Pictures')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pictures entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pictures', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Pictures entity.
     *
     * @Route("/{id}", name="pictures_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('pspiessContentBundle:Pictures')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Datensatz nicht gefunden.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('pictures'));
    }

    /**
     * Creates a form to delete a Pictures entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('pictures_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-danger'), 'label' => 'löschen'))
                        ->getForm()
        ;
    }

}
