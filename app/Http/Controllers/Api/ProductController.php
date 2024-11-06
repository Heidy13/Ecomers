<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $product = Product::all();
            return response()->json($product, 200);
            
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
        
    }

    public function store(Request $request)
    {
        try {
            $product = Product::create([
                'name'=> $request->input('name'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'stock' => $request->input('stock'),
                'image' => $request->input('image'),
                'create_date' => $request->input('create_date'),
                'id_user' => $request->input('id_user'),
                'id_category' => $request->input('id_category')
            ]);

            return response()->json(['message'=>'Producto creado'], 201);

        } catch (Exception $e) {
            return response()-> json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $product = Product::find($id);

         if ($product) {
            $product->name = $request->input('name');
            $product->description = $request->input('description');
            $product->price = $request->input('price');
            $product->stock = $request->input('stock');
            $product->image = $request->input('image');
            $product->create_date = $request->input('create_date');
            $product->id_user = $request->input('id_user');
            $product->id_category = $request->input('id_category');

            $product -> save();
         } else {
            return response()->json(['error'=> 'Empresa no encontrada']);
         }
               
            return response()->json(['message' => 'Producto actualizado'], 200);

        } catch (Exception $e) {
            return response()-> json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['error'=>'Producto no encontrado'], 400);
            }
            
            $product->delete();
            
            return response()->json(['message'=> 'Pruducto eliminado correctamente'], 200);
        } catch (Exception $e) {
            return response()->json(['error'=>'An error ocurrerd: '.$e->getMessage()]);
        }
    }
}
