<?php

namespace App\Controllers;
use App\Models\Producto;

class ProductosController extends BaseController
{
    public function index()
    {
        $product = new Producto();
        $data = $product->findAll();
        return json_encode($data);
    }

    public function showOne($id)
    {
        $product = new Producto();
        $data = $product->find($id);
        return json_encode($data);
    }


    public function create()
    {
        $product = new Producto();
        
        $data = $this->request->getJSON(true);//Para devolver el json como array asociativo TRUE

        if($product->insert($data))
        {
            return $this->response->setJSON(['message' => 'Producto creado correctamente']);
        }
        else
        {
            return $this->response->setJSON(['message' => 'Error al crear el producto']);
        }
    }
    public function delete($id)
    {
        $product = new Producto();     
        $data = $product->find($id);
        if(!$data)
        {
            return $this->response->setJSON(['message' => 'Producto no existe']);
        }        
        if($product->delete($id))
        {
            return $this->response->setJSON(['message' => 'Producto borrado correctamente']);
        }
        else
        {
            return $this->response->setJSON(['message' => 'Fallo al borrar producto']);
        }
        
    }

    public function modify($id)
    {
        $request = $this->request;
        $dataRequest = $request->getJSON(true);
        
        $product = new Producto(); 
        $dataProduct = $product->find($id);

        if(!$dataProduct)
        {
            return $this->response->setJSON(['message' => 'Producto no existe']);
        }
        if ($product->update($id,$dataRequest)) {
            return $this->response->setJSON(['message' => 'Producto modificado correctamente']);
        } else {
            return $this->response->setJSON(['message' => 'Error al modificar producto']);
        }
    }
}
