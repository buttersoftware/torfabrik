<?php

namespace pspiess\ContentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\ContentBundle\Entity\Slider;
use pspiess\ContentBundle\Form\SliderType;

/**
 * slider controller.
 *
 * @Route("/slider")
 */
class SliderController extends Controller
{

    /**
     * Lists all slider entities.
     *
     * @Route("/", name="slider")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessContentBundle:Slider')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new slider entity.
     *
     * @Route("/", name="slider_create")
     * @Method("POST")
     * @Template("pspiessContentBundle:slider:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new slider();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('slider_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a slider entity.
    *
    * @param slider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(slider $entity)
    {
        //dont like
        
        $form = $this->createForm(new SliderType(), $entity, array(
            'action' => $this->generateUrl('slider_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'erstellen'))
              ->remove('created')
              ->remove('submit')
              ->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new slider entity.
     *
     * @Route("/new", name="slider_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new slider();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a slider entity.
     *
     * @Route("/{id}", name="slider_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Slider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find slider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }
    
        /**
     * Present the slider
     *
     * @Route("/", name="slider_present")
     * @Template()
     */
    public function presentAction()
    {
        $em = $this->getDoctrine()->getManager();

        $slider = $em->getRepository('pspiessContentBundle:slider')->findBy(array('active' => 0, 'active' => 1), array('id' => 'desc'));
                
        if (!$slider) {
            throw $this->createNotFoundException('Silder entity nicht gefunden.');
        }
        
        return array(
            'slider'      => $slider
        );
    }

    /**
     * Displays a form to edit an existing slider entity.
     *
     * @Route("/{id}/edit", name="slider_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Slider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find slider entity.');
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
    * Creates a form to edit a slider entity.
    *
    * @param slider $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Slider $entity)
    {
        $form = $this->createForm(new SliderType(), $entity, array(
            'action' => $this->generateUrl('slider_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        
        $form->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-success'), 'label' => 'ändern'));

        return $form;
    }
    /**
     * Edits an existing slider entity.
     *
     * @Route("/{id}", name="slider_update")
     * @Method("PUT")
     * @Template("pspiessContentBundle:slider:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessContentBundle:Slider')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find slider entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $em->flush();
            return $this->redirect($this->generateUrl('slider_show', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a slider entity.
     *
     * @Route("/{id}", name="slider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessContentBundle:Slider')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find slider entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('slider'));
    }

    /**
     * Creates a form to delete a slider entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('slider_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('erstellen', 'submit', array('attr' => array('class' => 'btn btn-danger'), 'label' => 'löschen'))
            ->getForm()
        ;
    }
}
