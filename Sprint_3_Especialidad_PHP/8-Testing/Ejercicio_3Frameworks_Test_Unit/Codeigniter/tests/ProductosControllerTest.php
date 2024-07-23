<?php

namespace Tests\App\Controllers;

use CodeIgniter\Test\FeatureTestTrait;
use CodeIgniter\Test\CIUnitTestCase;

class ProductosControllerTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testIndex()
    {
        $result = $this->call('get','/');

        $this->assertTrue($result->isOk());
        $this->assertJson($result->getJSON());

    }
    public function testUpdate()
    {
        $data = [
            'name' => 'Nombre tester',
            'description' => 'Descriptiton Test',
            'price' => 0.99,
            'stock' => 9
        ];

        $this->withHeaders(['Content-Type' => 'application/json']);

        $model = new \App\Models\Producto();
        $lastProductId = $model->selectMax('id')->first()['id'];

        $result = $this->withBody(json_encode($data),'application/json')->put('modify/'.$lastProductId,$data);

        $updatedProduct = $model->find($lastProductId);

        $this->assertTrue($result->isOk());
        $this->assertNotNull($updatedProduct);
        $this->assertEquals($data['name'],$updatedProduct['name']);
        $this->assertEquals($data['description'],$updatedProduct['description']);
        $this->assertEquals($data['price'],$updatedProduct['price']);
        $this->assertEquals($data['stock'],$updatedProduct['stock']);
    }
    
    public function testCreate()
    {
        $data = [
            'name' => 'Nombre tester Creacion',
            'description' => 'Descriptiton Test Creacion',
            'price' => 0.99,
            'stock' => 9
        ];

        $this->withHeaders(['Content-Type' => 'application/json']);

        $model = new \App\Models\Producto();

        $result = $this->withBody(json_encode($data),'application/json')->post('/create',$data);

        $lastProductId = $model->selectMax('id')->first()['id'];
        $createdProduct = $model->find($lastProductId);

        $this->assertTrue($result->isOk());
        $this->assertNotNull($createdProduct);
        $this->assertEquals($data['name'],$createdProduct['name']);
        $this->assertEquals($data['description'],$createdProduct['description']);
        $this->assertEquals($data['price'],$createdProduct['price']);
        $this->assertEquals($data['stock'],$createdProduct['stock']);
    }

    public function testShowOne()
    {
        //Data del test anterior para verificar
        $data = [
            'name' => 'Nombre tester Creacion',
            'description' => 'Descriptiton Test Creacion',
            'price' => 0.99,
            'stock' => 9
        ];

        $model = new \App\Models\Producto();
        $lastProductId = $model->selectMax('id')->first()['id'];
        $result = $this->call('get','/'.$lastProductId);

        $findedProduct = $model->find($lastProductId);

        $this->assertTrue($result->isOk());
        $this->assertJson($result->getJSON());
        
        //Comprueba con el test de creacion anterior para ver 
        //si se encontro un producto por id correctamente
        $this->assertEquals($data['name'],$findedProduct['name']);
        $this->assertEquals($data['description'],$findedProduct['description']);
        $this->assertEquals($data['price'],$findedProduct['price']);
        $this->assertEquals($data['stock'],$findedProduct['stock']);
    }

    public function testDelete()
    {
        $model = new \App\Models\Producto();
        $lastProductId = $model->selectMax('id')->first()['id'];

        $result = $this->delete('delete/'.$lastProductId);

        $deletedProduct = $model->find($lastProductId);

        $this->assertTrue($result->isOk());
        $this->assertNull($deletedProduct);

    }


}
