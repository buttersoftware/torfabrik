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
//        $menu['Kunden']->addChild('Profile', array('uri' => '#'))->setAttribute('divider_append', true);
//        $menu['Kunden']->addChild('Logout', array('uri' => '#'));

        $menu->addChild('Felder', array('route' => 'pspiess_letsplay_field'))
                ->setAttribute('icon', 'fa fa-square');

        $menu->addChild('Preise', array('route' => 'pspiess_letsplay_price'))
                ->setAttribute('icon', 'fa fa-eur');
        
        $menu->addChild('Kategorie', array('route' => 'pspiess_letsplay_category'))
                ->setAttribute('icon', 'fa fa-tasks');
        
        $menu->addChild('Rechnungen', array('route' => 'pspiess_letsplay_invoice'))
                ->setAttribute('icon', 'fa fa-list-alt');

        $menu->addChild('Kassenabschluss', array('route' => 'pspiess_letsplay_cashingup'))
                ->setAttribute('icon', 'fa fa-list-alt')->actsLikeFirst();

        $menu->addChild('Umsatz: ' . $this->GetAmountofPayoffice() . ' €', array('route' => 'pspiess_letsplay_payoffice'))
                ->setAttribute('icon', 'fa fa-list-alt')->actsLikeFirst();

        return $menu;
    }

    private function GetAmountofPayoffice() {
        $em = $this->container->get('doctrine.orm.entity_manager');
        //Todo: need to check the user!
        $entPayoffice = $em->getRepository('pspiessLetsplayBundle:Payoffice')->getOnePayoffice();
        
        $dAmount = 0;
        if ($entPayoffice != null) {
            foreach ($entPayoffice->getPayofficepos() as $obj) {
                $dAmount = $dAmount + $obj->getAmount();
            }
        }
        return $dAmount;
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
