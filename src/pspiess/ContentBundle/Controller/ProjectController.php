<?php

namespace pspiess\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use pspiess\ContentBundle\Entity\Project;
use pspiess\ContentBundle\Form\ProjectType;


/**
 * Project controller.
 *
 * @Route("/project")
 */
class ProjectController extends Controller {

    /**
     * Lists all Project entities.

     * @Route("/", name="project")
     * @Method("GET")
     * @Template()
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessContentBundle:Project')->findAll();
        
        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Project entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="project_create")
     * @Method("POST")
     * @Template("pspiessContentBundle:Project:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Project();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('project', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Project entity.
     *
     * @param Project $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Project $entity) {
        $form = $this->createForm(new ProjectType(), $entity, array(
            'action' => $this->generateUrl('project_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Project entity.
     *
     * @Route("/new", name="project_new")
     * @Security("has_role('ROLE_USER')")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $entity = new Project();
        $form = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Project entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}", name="project_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }
        
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Finds and displays a Project.
     * @Route("/present/{id}", name="projects_show")
     * @Method("GET")
     * @Template()
     */
    public function presentAction($id) {
        $em = $this->getDoctrine()->getManager();

        $project = $em->getRepository('pspiessContentBundle:Project')->find($id);
        //\Doctrine\Common\Util\Debug::dump($project);
        if (!$project) {
            throw $this->createNotFoundException('Nichts gefunden');
        }

        return array(
            'project' => $project,
        );
    }

    /**
     * Displays a form to edit an existing Project entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}/edit", name="project_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
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
     * Creates a form to edit a Project entity.
     * @Security("has_role('ROLE_USER')")
     * @param Project $entity The entity
     * 
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Project $entity) {
        $form = $this->createForm(new ProjectType(), $entity, array(
            'action' => $this->generateUrl('project_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-success'), 'label' => 'ändern'));

        return $form;
    }

    /**
     * Edits an existing Project entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}", name="project_update")
     * @Method("PUT")
     * @Template("pspiessContentBundle:Project:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Project')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Project entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('project', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Project entity.
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}", name="project_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessContentBundle:Project')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Project entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('project'));
    }

    /**
     * Creates a form to delete a Project entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('project_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-danger'), 'label' => 'löschen'))
                        ->getForm()
        ;
    }

}
