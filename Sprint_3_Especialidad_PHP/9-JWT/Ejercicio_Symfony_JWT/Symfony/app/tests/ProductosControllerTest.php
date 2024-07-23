<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductosControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();
        $client->request('GET','/');

        $content = $client->getResponse()->getContent();
        $products = json_decode($content, true);

        //Asserts
        $this->assertResponseIsSuccessful();
        $this->assertIsArray($products);
        $this->assertArrayHasKey('id',$products[0]);
        $this->assertArrayHasKey('name',$products[0]);
        $this->assertArrayHasKey('price',$products[0]);
        $this->assertArrayHasKey('stock',$products[0]);
    }

    public function testCreate()
    {
        $client = static::createClient();
        $data = [
            'name' => 'Prod_Test',
            'description' => 'Descripcion_Test',
            'price' => "100.60",
            'stock' => 50
        ];

        $client->request('POST', '/create', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));

        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $response = json_decode($content, true);

        $this->assertEquals('Producto añadido correctamente', $response[1]);
    }

    public function testShowOne(): void
    {
        $client = static::createClient();
    
        // Prueba para un producto existente
        $client->request('GET', '/showOne/2');
        $this->assertResponseIsSuccessful();
    
        // Prueba para un producto no existente
        $client->request('GET', '/showOne/999');
        $this->assertResponseStatusCodeSame(404);
    }
    
    public function testDelete(): void
    {
        $client = static::createClient();
    
        // Prueba para un producto existente
        $client->request('DELETE', '/delete/6');
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $response = json_decode($content, true);
        $this->assertEquals('Producto borrado correctamente', $response[1]);
    
        // Prueba para un producto no existente
        $client->request('DELETE', '/delete/999');
        $this->assertResponseStatusCodeSame(404);
    }
        
    public function testModify(): void
    {
        $client = static::createClient();
        $data = [
            'name' => 'Updated Product',
            'price' => '150',
            'stock' => 75
        ];
    
        // Prueba para un producto existente
        $client->request('PUT', '/modify/2', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        $response = json_decode($content, true);
        $this->assertEquals('Producto modificado', $response['status']);
    
        // Prueba para un producto no existente
        $client->request('PUT', '/modify/999', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));
        $this->assertResponseStatusCodeSame(404);
    }    
}