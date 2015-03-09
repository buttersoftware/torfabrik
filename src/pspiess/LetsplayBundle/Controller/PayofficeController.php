<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\LetsplayBundle\Entity\Payoffice;

/**
 * Payoffice controller.
 *
 * @Route("/payoffice")
 */
class PayofficeController extends Controller {

    /**
     * Lists all Payoffice entities.
     *
     * @Route("/", name="payoffice")
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entPayoffice = $em->getRepository('pspiessLetsplayBundle:Payoffice')->findAll();
        //verstehe ich nicht! invoice von der payofficepos wird nicht mitgenommen

        return array(
            'payoffice' => $entPayoffice,
        );
    }

    /**
     * open Payoffice if not open
     *
     * @Route("/new", name="payoffice_new")
     * @Method("GET")
     */
    public function newAction() {
        $em = $this->getDoctrine()->getManager();

        $entPayoffice = new Payoffice();
        $entPayoffice->setOpened(new \DateTime('now'));
        
        if ($em->getRepository('pspiessLetsplayBundle:Payofficepos')->findAll() == null) {
            $em->persist($entPayoffice);
            $em->flush($entPayoffice);
        }
        
        return $this->redirect($this->generateUrl('pspiess_letsplay_payoffice'));
    }

}
