<?php

namespace pspiess\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use pspiess\BlogBundle\Form\FeedbackType;
use pspiess\BlogBundle\Form\ReportType;


class MainController extends Controller {

    /**
     * Get the all blogs by parameter 
     * @param Request $request
     * @return type Blog Entity
     */
    public function indexAction(Request $request) {
        $form = $this->createForm(new ReportType());
        $paginator = $this->get('knp_paginator');

        $entStaticBlog = null;
        $entRandomBlog = null;
        $entBlog = $this->getDoctrine()->getRepository('pspiessBlogBundle:Blog')->GetBlogByName('asd21ddasd 12ed asd 122e 1d', $request->query->get('maincategory', ''), $request->query->get('subcategory', ''), 1);
        
        $keyword = $request->query->get('keyword', '');

        if ($keyword == 'Bitte hier Suchbergriff eingeben...') {
            $keyword = '';
        }
        
        if ($keyword == null && $request->query->get('maincategory', null) == null && $request->query->get('subcategory', null) == null) {
            $entStaticBlog = $this->getDoctrine()->getRepository('pspiessBlogBundle:Blog')->GetBlogByName(null, null, null, null, 1);
            $entRandomBlog = $this->getDoctrine()->getRepository('pspiessBlogBundle:Blog')->GetRandomBlogByName();
        } else {
            $entBlog = $this->getDoctrine()->getRepository('pspiessBlogBundle:Blog')->GetBlogByName($keyword, $request->query->get('maincategory', ''), $request->query->get('subcategory', ''), 1);
        }

        $entMaincategory = $this->getDoctrine()->getRepository('pspiessBlogBundle:Maincategory')->findAll();
        $entSubcategory = $this->getDoctrine()->getRepository('pspiessBlogBundle:Subcategory')->GetSubcategoryByName('', $request->query->get('maincategory', ''));
        $entities = $paginator->paginate(
                $entBlog, $request->query->get('page', 1), 50
        );

        return $this->render('pspiessBlogBundle:Main:index.html.twig', array(
                    'report_form' => $form->createView(),
                    'staticentities' => $entStaticBlog,
                    'randomentities' => $entRandomBlog,
                    'entities' => $entities,
                    'maincategory' => $entMaincategory,
                    'subcategory' => $entSubcategory,
                    'keyword' => $request->query->get('keyword', ''),
                    'maincategory_selected' => $request->query->get('maincategory', ''),
                    'subcategory_selected' => $request->query->get('subcategory', '')
                        )
        );
    }

    /**
     * Go to impressum page
     */
    public function impressumAction() {
        return $this->render('pspiessBlogBundle:Main:impressum.html.twig', array('entities' => null));
    }

    /**
     * Go to impressum page
     */
    public function partnersAction() {
        return $this->render('pspiessBlogBundle:Main:partners.html.twig', array('entities' => null));
    }

    /**
     * Go to advertise page
     */
    public function advertiseAction() {
        return $this->render('pspiessBlogBundle:Main:advertise.html.twig', array('entities' => null));
    }

    /**
     * Go to slider page
     */
    public function sliderAction() {
        return $this->render('pspiessBlogBundle:Main:slider.html.twig', array('entities' => null));
    }

    /**
 * Go to feedback page and save
 * @param Request $request
 * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
 */
    public function feedbackAction(Request $request) {
        $form = $this->createForm(new FeedbackType());

        if ($request->isMethod('POST')) {
            $form->bind($request);
            //\Doctrine\Common\Util\Debug::dump($request);
            if ($form->isValid()) {
                $message = \Swift_Message::newInstance()
                    ->setSubject($form->get('subject')->getData())
                    ->setFrom($form->get('email')->getData())
                    ->setTo('info@pspiess.de')
                    ->setBody(
                        $this->renderView(
                            'pspiessBlogBundle:Elements:mail.html.twig', array(
                                'ip' => $request->getClientIp(),
                                'name' => $form->get('name')->getData(),
                                'email' => $form->get('email')->getData(),
                                'subject' => $form->get('subject')->getData(),
                                'message' => $form->get('message')->getData()
                            )
                        ), 'text/html'
                    ) ;

                $this->get('mailer')->send($message);

                $request->getSession()->getFlashBag()->add('success', 'Deine Email wurde versenden! Danke!');

                return $this->redirect($this->generateUrl('pspiess_blog_feedback_response'));
            }
        }

        return $this->render('pspiessBlogBundle:Main:feedback.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Go to feedback response page and save
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function feedback_responseAction() {
        return $this->render('pspiessBlogBundle:Main:feedback_response.html.twig', array('entities' => null));
    }
}
