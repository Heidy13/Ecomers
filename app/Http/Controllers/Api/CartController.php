<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(),[
            'amount'=>'required|integer',
            'id_user'=>'required|integer|exists:users,id',
            'id_product'=>'required|integer|exists:product,id',
        ]);
        if ($validator -> fails()) {
            return response()->json([
                'message' => 'Error de validación.',
                'error' => $validator->errors()
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $cart = Cart::create($validator->validate());
        return response()->json([
            'message' => 'Carrito creado con exito.',
            // 'cart' => $cart
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $car = Cart::find($id);
        if (!$car) {
            return response()->json(['error' => 'Carrito no encontrado.'],Response::HTTP_NOT_FOUND);
        }
        $cart = array (
           'amount' => $car -> amount, 
           'date_added' => $car -> date_added, 
           'id_user' => $car -> id_user, 
           'id_product' => $car -> id_product 
        );
        return response()->json($cart);


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
        //
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['error' => 'Carrito no encontrado.']);
        }
        $validator = Validator::make($request->all(),[
            'amount'=>'required|integer',
            'id_product'=>'required|integer|exists:product,id',
        ]);
        if ($validator -> fails()) {
            return response()->json([
                'message'=> 'Error de validación.',
                'error' => $validator->errors()
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $cart->update($validator->validate());
        return response()->json(['message' => 'Carrito actualizado correctamente.'],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cart = Cart::find($id);
        if (!$cart) {
            return response()->json(['error' => 'Carrito no encontrado.']);
        }
        $cart->delete();
        return response()->json(['message' => 'Carrito eliminado correctamente.'],Response::HTTP_OK);    
    }
}
