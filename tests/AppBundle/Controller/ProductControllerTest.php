<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testGetAllProducts()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/api/products', array(), array(), array('HTTP_ACCEPT' => 'application/json'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCreateNewProduct()
    {
        $data = ['name' => "Product", "price" => 12.5];
        $client = static::createClient();
        $crawler = $client->request('POST', '/api/products', array(), array(), array('HTTP_ACCEPT' => 'application/json'), json_encode($data));
        $this->assertEquals(201, $client->getResponse()->getStatusCode());
    }
}
