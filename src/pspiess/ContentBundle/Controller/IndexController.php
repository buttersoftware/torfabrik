<?php

namespace pspiess\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use pspiess\ContentBundle\Form\ContactType;

class IndexController extends Controller {

    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('pspiessContentBundle:Slider')->findall();
        return array(
            'entities' => $entities,
        );
    }

    /**
     * @Route("/offer")
     * @Template()
     */
    public function offerAction() {
        return array();
    }

    /**
     * @Route("/projects", name="projects")
     * @Template()
     */
    public function projectsAction() {
        $em = $this->getDoctrine()->getManager();

        //$projects = $em->getRepository('pspiessContentBundle:Project')->findall();
        $projects = $em->getRepository('pspiessContentBundle:Project')->findBy(array('active' => 1), array('id' => 'desc'));


//        print "\<pre\>";
//            \Doctrine\Common\Util\Debug::dump($projects);
//        print "\</pre\>";

        return array(
            'projects' => $projects,
        );
    }

    /**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction(Request $request) {
        $form = $this->createForm(new ContactType());

        if ($request->isMethod('POST')) {
            $form->bind($request);
            //\Doctrine\Common\Util\Debug::dump($request);
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                        ->setSubject($form->get('subject')->getData())
                        ->setFrom($form->get('email')->getData())
                        ->setTo('info@gp-fahrzeugtechnik.de')
                        ->setBody(
                        $this->renderView(
                                'pspiessContentBundle:Index:mail.html.twig', array(
                            'ip' => $request->getClientIp(),
                            'name' => $form->get('name')->getData(),
                            'message' => $form->get('message')->getData()
                                )
                        ), 'text/html'
                ) ;

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Deine Email wurde versenden! Danke!');

                return $this->redirect($this->generateUrl('_contact'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }
    
    /**
     * @Route("/impressum")
     * @Template()
     */
    public function impressumAction() {
        return array();
    }
}
