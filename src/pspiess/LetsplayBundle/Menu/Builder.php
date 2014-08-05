<?php

namespace pspiess\LetsplayBundle\Menu;

Use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Preis', array('route' => 'price'));
        $menu->addChild('Felder', array(
            'route' => 'field',
            'routeParameters' => array('id' => 42)
        ));
        // ... add more children

        return $menu;
    }
}
