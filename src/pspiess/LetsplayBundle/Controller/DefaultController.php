<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

    public function projectsAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

    public function addProjectAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

    public function priceAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

    public function addPriceAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

    public function profileAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

}
