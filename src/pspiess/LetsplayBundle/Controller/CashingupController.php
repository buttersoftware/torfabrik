<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Cashingup;
use pspiess\LetsplayBundle\Form\CashingupType;

/**
 * Cashingup controller.
 *
 * @Route("/cashingup")
 */
class CashingupController extends Controller {

    /**
     * Lists all Cashingup entities.
     *
     * @Route("/", name="cashingup")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessLetsplayBundle:Cashingup')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Creates a new Cashingup entity.
     *
     * @Route("/", name="cashingup_create")
     * @Method("POST")
     * @Template("pspiessLetsplayBundle:Cashingup:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Cashingup();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);

            $arrPayofficepos = $em->getRepository('pspiessLetsplayBundle:Payofficepos')->GetPayofficeposByDate($entity->getDaydate());
            foreach ($arrPayofficepos as $entPayofficepos) {
                $em->remove($entPayofficepos);
            }

            if ($em->getRepository('pspiessLetsplayBundle:Payofficepos')->findAll() == null) {
                $arrPayoffice = $em->getRepository('pspiessLetsplayBundle:Payoffice')->findAll();
                foreach ($arrPayoffice as $entPayoffice) {
                    $em->remove($entPayoffice);
                }
            }

            $em->flush();

            return $this->redirect($this->generateUrl('pspiess_letsplay_payoffice'));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Cashingup entity.
     *
     * @param Cashingup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Cashingup $entity) {
        $form = $this->createForm(new CashingupType(), $entity, array(
            'action' => $this->generateUrl('pspiess_letsplay_cashingup_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'abrechnen', 'attr' => array('class' => 'btn btn-success')));

        return $form;
    }

    /**
     * Displays a form to create a new Cashingup entity.
     *
     * @Route("/new", name="cashingup_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction() {
        $em = $this->getDoctrine()->getManager();
        
        $entCachingup = new Cashingup();
        
        $arrPayofficeposBar = $em->getRepository('pspiessLetsplayBundle:Payofficepos')->GetOnePayofficeposByDate();
        foreach ($arrPayofficeposBar as $row) {
            $entCachingup->setNominal($row['total']);
        }
        
        $arrPayofficeposEc = $em->getRepository('pspiessLetsplayBundle:Payofficepos')->GetOnePayofficeposByDate('EC Karte');
        foreach ($arrPayofficeposEc as $row) {
            $entCachingup->setNominalec($row['total']);
        }
        
        $entCachingup->setDaydate(new \DateTime($row['date']));
        $form = $this->createCreateForm($entCachingup);

        return array(
            'entity' => $entCachingup,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Cashingup entity.
     *
     * @Route("/{id}", name="cashingup_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Cashingup')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cashingup entity.');
        }

//        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
//            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Cashingup entity.
     *
     * @Route("/{id}/edit", name="cashingup_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Cashingup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cashingup entity.');
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
     * Creates a form to edit a Cashingup entity.
     *
     * @param Cashingup $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Cashingup $entity) {
        $form = $this->createForm(new CashingupType(), $entity, array(
            'action' => $this->generateUrl('cashingup_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Cashingup entity.
     *
     * @Route("/{id}", name="cashingup_update")
     * @Method("PUT")
     * @Template("pspiessLetsplayBundle:Cashingup:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('pspiessLetsplayBundle:Cashingup')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Cashingup entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cashingup_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Cashingup entity.
     *
     * @Route("/{id}", name="cashingup_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('pspiessLetsplayBundle:Cashingup')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Cashingup entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cashingup'));
    }

    /**
     * Creates a form to delete a Cashingup entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('cashingup_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }

}
