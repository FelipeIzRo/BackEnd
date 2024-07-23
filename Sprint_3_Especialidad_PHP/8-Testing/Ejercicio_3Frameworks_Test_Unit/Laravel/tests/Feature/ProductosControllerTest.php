<?php

namespace Tests\Feature;

use App\Entity\Productos;
use App\Models\Producto;
use Illuminate\Http\Response;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProductosControllerTest extends TestCase
{
    use WithoutMiddleware;

    public function testCreate()
    {
        $data=[
            'name' => 'Creacion_Test_Laravel',
            'description' => 'Descripcion_Test_Laravel',
            'price' => 0.99,
            'stock' => 33
        ];

        $response = $this->post('/',$data);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertEquals($data['name'],$response->json('name'));
        $this->assertEquals($data['description'],$response->json('description'));
        $this->assertEquals($data['price'],$response->json('price'));
        $this->assertEquals($data['stock'],$response->json('stock'));
    }

    public function testUpdate()
    {
        $id = 3;
        $dataList=[
            'name'=>'ModificacionLaravel',
            'description'=>'ModificacionLaravel',
            'price'=>0.99,
            'stock'=>8
        ];
        $data=[
            "changes" => [
            ["field" => "name", "value" => $dataList['name']],
            ["field" => "description", "value" => $dataList['description']],
            ["field" => "price", "value" => $dataList['price']],
            ["field" => "stock", "value" => $dataList['stock']]
            ]
        ];


        $response = $this->put("/modify_json/".$id,$data);


        $producto = Producto::find($id);

        $response->assertStatus(Response::HTTP_OK);
        $this->assertEquals($dataList['name'], $producto->name);
        $this->assertEquals($dataList['description'], $producto->description);
        $this->assertEquals($dataList['price'], $producto->price);
        $this->assertEquals($dataList['stock'], $producto->stock);
        
    }

    public function testShowOne()
    {
        $productos = Producto::all();

        $response = $this->get('/'.$productos[0]->id);
        $response->assertstatus(200);
    }

    public function testDelete()
    {
        $productos = Producto::all();
        $lastProductId = $productos->last()->id;

        $response = $this->delete('/delete/'.$lastProductId);
        $response->assertstatus(201);
    }
}
