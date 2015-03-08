<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Payoffice controller.
 *
 * @Route("/payoffice")
 */
class PayofficeController extends Controller
{

    /**
     * Lists all Payoffice entities.
     *
     * @Route("/", name="payoffice")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entPayoffice = $em->getRepository('pspiessLetsplayBundle:Payoffice')->findAll();
        //verstehe ich nicht! invoice von der payofficepos wird nicht mitgenommen
        //$entPayofficepos = $em->getRepository('pspiessLetsplayBundle:Payofficepos')->getPayofficepos();
//        print_r($entPayoffice);
        return array(
            'payoffice' => $entPayoffice,
//            'payofficepos' => $entPayofficepos,
        );
    }
}
