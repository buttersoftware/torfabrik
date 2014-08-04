<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WelcomeController extends Controller
{
    public function indexAction()
    {
        $user = $this->container->get('fos_user.user_manager')
                ->findUserByUsername('petja');
//        var_dump($user);
//        die;
        return $this->render('AcmeDemoBundle:Welcome:index.html.twig');
    }
}
