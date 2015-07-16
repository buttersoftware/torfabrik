<?php

namespace pspiess\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller {

    /**
     * Get the all blogs by parameter 
     * @param Request $request
     * @return type Blog Entity
     */
    public function indexAction(Request $request) {

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
                    'staticentities' => $entStaticBlog,
                    'randomentities' => $entRandomBlog,
                    'entities' => $entities,
                    'maincategory' => $entMaincategory,
                    'subcategory' => $entSubcategory,
                    'keyword' => $request->query->get('keyword', 'Bitte hier Suchbergriff eingeben...'),
                    'maincategory_selected' => $request->query->get('maincategory', ''),
                    'subcategory_selected' => $request->query->get('subcategory', '')
                        )
        );
    }

    /**
     * Go to impressum site
     */
    public function impressumAction() {
        return $this->render('pspiessBlogBundle:Main:impressum.html.twig', array('entities' => null));
    }

    /**
     * Go to impressum site
     */
    public function partnersAction() {
        return $this->render('pspiessBlogBundle:Main:partners.html.twig', array('entities' => null));
    }

    /**
     * Go to advertise site
     */
    public function advertiseAction() {
        return $this->render('pspiessBlogBundle:Main:advertise.html.twig', array('entities' => null));
    }

}
