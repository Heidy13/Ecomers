<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return $product;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $product = $request->validate([
            'name' => 'required|string|unique:product,name',
            'description' => 'required|string|max:45',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'required',
            'id_user' => 'required|exists:users,id',
            'id_category' => 'required|exists:category,id',
        ]);
        Product::create($product);
        return response()->json(['message' => 'Producto creado con exito.'], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pro = Product::find($id);
        if (!$pro) {
            return response()->json(['error' => 'Producto no encontrado.'], Response::HTTP_NOT_FOUND);
        }

        $product = array(
            'name' => $pro->name,
            'description' => $pro->description,
            'price' => $pro->price,
            'stock' => $pro->stock,
            'image' => $pro->image,
            'id_category' => $pro->id_category //toca traer el nombre de la categoria no el id
        );
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pro = Product::find($id);
        if (!$pro) {
            return response()->json(['error' => 'Producto no encontrado.'], Response::HTTP_NOT_FOUND);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|unique:product,name,' . $id,
            'description' => 'required|string|max:45',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'image' => 'required',
            'id_category' => 'required|exists:category,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'error' => $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $pro->update($validator->validate());
        return response()->json(['message' => 'Producto actualizado con éxito.'], Response::HTTP_OK);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pro = Product::find($id);
        if (!$pro) {
            return response()->json(['error'=>'Producto no encontrado.'],Response::HTTP_NOT_FOUND);
        }
        $pro -> delete();
        return response()->json(['message'=>'Producto eliminado correctamente.'],Response::HTTP_OK);
    }
}
