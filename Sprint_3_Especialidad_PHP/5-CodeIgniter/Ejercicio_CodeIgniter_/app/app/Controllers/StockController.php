<?php

namespace App\Controllers;
use App\Models\Stock;

class StockController extends BaseController
{
    public function index()
    {
        $stock = new Stock();
        //$data['products'] = $stock->findAll();
        $data['products'] = $stock->getAllStock();
        return view('/stock_index',$data);
    }

    public function view($id)
    {
        $stock = new Stock();
        //$data['product'] = $stock->where('id',$id)->first();
        $data['product'] = $stock->getOneStock($id);
        return view('stock_view',$data);
    }
    public function create()
    {
        return view('stock_create');
    }

    public function create_post()
    {
        $stock = new Stock();
        $data = $this->request->getPost(['name', 'quantity', 'price']);

        $data['price'] = floatval($data['price']);

        if(!$this->validate($stock->getValidationRules(),$stock->getValidationMessages()))        
        {
            return view('stock_create',['validation'=>$this->validator]);            
        }
        else
        {
            $stock->save($data);
            return redirect()->to('/stock')->with('success', 'Producto añadido correctamente');
        }

        return view('stock_create');
    }

    public function remove($id)
    {
        $stock = new Stock();
        //$stock->delete($id);
        if($stock->removeOne($id))
        {
            return redirect()->to('/stock')->with('success', 'Producto eliminado');
        }
        else
        {
            return redirect()->to('/stock')->with('error', 'Error al eliminar el producto');
        }
        
    }

    public function edit ($id)
    {
        $stock = new Stock();
        //$data['product'] = $stock->where('id',$id)->first();
        $data['product'] = $stock->getOneStock($id);
        return view('stock_create',$data);
    }

    public function update($id) {
        $stock = new Stock();
        $data = $this->request->getPost(['quantity', 'price']);
        
        if ($stock->update($id, $data)) {
            return redirect()->to('/stock')->with('success', 'Producto modificado correctamente');
        } else {
            return redirect()->to('/stock')->with('error', 'Error de modificacion');
        }
    }
}
