<?php

namespace pspiess\LetsplayBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class MenuBuilder extends ContainerAware {

    public function mainMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav');
        
        $menu->addChild('Reservierungen', array('route' => 'pspiess_letsplay_booking'))
                ->setAttribute('icon', 'fa fa-calendar');

        $menu->addChild('Kunden', array('route' => 'pspiess_letsplay_customer'))
                ->setAttribute('icon', 'fa fa-users');
        
        $menu->addChild('Felder', array('route' => 'pspiess_letsplay_field'))
                ->setAttribute('icon', 'fa fa-square');
        
        $menu->addChild('Preise', array('route' => 'pspiess_letsplay_price'))
                ->setAttribute('icon', 'fa fa-eur');
        
        $menu->addChild('Rechnungen', array('route' => 'pspiess_letsplay_invoice'))
                ->setAttribute('icon', 'fa fa-list-alt');
        
        $menu->addChild('Kassenabschluss', array('route' => 'pspiess_letsplay_cashingup'))
                ->setAttribute('icon', 'fa fa-list-alt')->actsLikeFirst();
        
        return $menu;
    }

    public function userMenu(FactoryInterface $factory, array $options) {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttribute('class', 'nav navbar-nav navbar-right');

        /*
          You probably want to show user specific information such as the username here. That's possible! Use any of the below methods to do this.

          if($this->container->get('security.context')->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {} // Check if the visitor has any authenticated roles
          $username = $this->container->get('security.context')->getToken()->getUser()->getUsername(); // Get username of the current logged in user

         */
        $menu->addChild('User', array('label' => 'Hi visitor'))
                ->setAttribute('dropdown', true)
                ->setAttribute('icon', 'fa fa-user');

        $menu['User']->addChild('Edit profile', array('route' => 'pspiess_letsplay_profile'))
                ->setAttribute('icon', 'fa fa-edit');

        return $menu;
    }

}
