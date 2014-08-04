<?php

namespace pspiess\ContentBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NavigationControllerTest extends WebTestCase
{
    public function testNavigation()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/navigation');
    }

}
