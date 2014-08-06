<?php

namespace pspiess\LetsplayBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

    public function employeesAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

    public function addEmployeeAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

    public function profileAction() {
        return $this->render('pspiessLetsplayBundle:Default:index.html.twig');
    }

}
