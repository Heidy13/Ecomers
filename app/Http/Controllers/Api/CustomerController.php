<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Cart_detail;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function cartDetail(Request $request){

        try {
            $id_cart = $request->input('id_cart');
            $products = $request->input('products');

            foreach ($products as $product) {
                Cart_detail::create([
                    'amount' => $product['amount'],
                    'date_added' => now(),
                    'id_product' => $product['product_id'],
                    'id_cart' => $id_cart
                ]);
            }

            return response()->json(['message'=>'Detalles del carrito creado']);

        } catch (Exception $e) {
            return response()->json(['error' => 'error:'.$e->getMessage()]);
        }
    }

    public function cart(Request $request){

        try {
            $cart = Cart::create([
                'id_user' =>$request->input('id_user'),
            ]);

            return response()->json(['message'=>'Carrito creado']);

        } catch (Exception $e) {
            return response()->json(['error' => 'error:'.$e->getMessage()]);
        }

    }
}
