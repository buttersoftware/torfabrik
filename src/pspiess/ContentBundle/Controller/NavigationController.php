<?php

namespace pspiess\ContentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NavigationController extends Controller {

    /**
     * @Template()
     * @Route("menu/{menu}")
     */
    public function navigationAction($menu = 'index') {
        switch ($menu) {
            case 'offer':
                $arrMenu = array('index' => '', 'offer' => 'active', 'projects' => '', 'contact' => '');
                break;
            case 'projects':
                $arrMenu = array('index' => '', 'offer' => '', 'projects' => 'active', 'contact' => '');
                break;
            case 'contact':
                $arrMenu = array('index' => '', 'offer' => '', 'projects' => '', 'contact' => 'active');
                break;
            default:
                $arrMenu = array('index' => 'active', 'offer' => '', 'projects' => '', 'contact' => '');
                break;
        }
        return $arrMenu;
    }

    /**
     * @Template()
     * @Route("header/{header}")
     */
    public function headerAction($header = '') {
        return array('header' => $header);
    }

}
