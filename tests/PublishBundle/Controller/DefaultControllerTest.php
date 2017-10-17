<?php

namespace MyCompany\PublishBundle\Tests\Controller;

use \PHPUnit\Framework\TestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en');
        $this->assertEquals(200 , $client->getResponse()->getStatusCode());
        $this->assertContains('Homepage', $client->getResponse()->getContent());
    }
}
