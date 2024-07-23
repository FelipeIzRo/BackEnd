<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Rules\YearValidationRule;
use Illuminate\Http\JsonResponse;


class ProductosController extends Controller
{
    public function index()
    {
        $products = Producto::all();
        return json_encode($products);
    }

    public function showOne($id)
    {
        $product = Producto::find($id);
        return json_encode($product);
    }

    public function store(Request $request)
    {
        
        $data = $request->validate(
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
                'stock' => 'required'
            ]);


        $product = Producto::create($data);
        
        $product['message']= 'Producto añadido correctamente';
        return new JsonResponse($product,201);
        
    }
    public function delete($id)
    {
        $product = Producto::find($id);

        if($product)
        {
            $product->delete();

            return new JsonResponse(['message'=>'Producto eliminado con exito'],201);
        }
        else
        {
            return new JsonResponse(['message'=>'Producto no encontrado'],404);
        }
    }

    public function modify(Request $request, $id, $field, $value)
    {
        
        $allowedFields = ['name', 'description', 'price', 'stock'];

        // Validar que el campo solicitado sea uno de los campos permitidos
        if (!in_array($field, $allowedFields)) {
            return new JsonResponse(['message' => 'Campo no permitido para modificar'], 400);
        }

        $producto = Producto::find($id);

        if (!$producto) {
            return new JsonResponse(['message' => 'Producto no encontrado'], 404);
        }

        $producto->{$field} = $value;

        $producto->save();

        return new JsonResponse([
            'message' => 'Campo ' . $field . ' modificado correctamente',
            'product' => $producto,
        ]);
    }

    public function modify_json(Request $request, $id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return new JsonResponse(['message' => 'Producto no encontrado'], 404);
        }

        // Aplicar cada cambio recibido
        foreach ($request->input('changes') as $change) {
            $field = $change['field'];
            $value = $change['value'];

            $producto->{$field} = $value;
        }

        $producto->save();

        return new JsonResponse([
            'message' => 'Campos modificados correctamente',
            'product' => $producto,
        ]);
    }
    
}
