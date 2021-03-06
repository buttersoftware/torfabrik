<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Invoicepos;
use pspiess\LetsplayBundle\Form\InvoiceposType;

/**
 * Invoicepos controller.
 *
 * @Route("/invoicepos")
 */
class InvoiceposController extends Controller
{

    /**
     * Lists all Invoicepos entities.
     *
     * @Route("/", name="invoicepos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessLetsplayBundle:Invoicepos')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Invoicepos entity.
     *
     * @Route("/", name="invoicepos_create")
     * @Method("POST")
     * @Template("pspiessLetsplayBundle:Invoicepos:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Invoicepos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('invoicepos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Invoicepos entity.
     *
     * @param Invoicepos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Invoicepos $entity)
    {
        $form = $this->createForm(new InvoiceposType(), $entity, array(
            'action' => $this->generateUrl('invoicepos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Invoicepos entity.
     *
     * @Route("/new", name="invoicepos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Invoicepos();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Invoicepos entity.
     *
     * @Route("/{id}", name="invoicepos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoicepos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoicepos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Invoicepos entity.
     *
     * @Route("/{id}/edit", name="invoicepos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoicepos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoicepos entity.');
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
    * Creates a form to edit a Invoicepos entity.
    *
    * @param Invoicepos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Invoicepos $entity)
    {
        $form = $this->createForm(new InvoiceposType(), $entity, array(
            'action' => $this->generateUrl('invoicepos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Invoicepos entity.
     *
     * @Route("/{id}", name="invoicepos_update")
     * @Method("PUT")
     * @Template("pspiessLetsplayBundle:Invoicepos:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Invoicepos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Invoicepos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('invoicepos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Invoicepos entity.
     *
     * @Route("/{id}", name="invoicepos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessLetsplayBundle:Invoicepos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Invoicepos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('invoicepos'));
    }

    /**
     * Creates a form to delete a Invoicepos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('invoicepos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
