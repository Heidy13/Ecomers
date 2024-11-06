<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $order = Order::create([
                'state' => $request -> state,
                'total' => $request -> total,
                'shipping_address' => $request -> shipping_address,
                'order_date' => now(),
                'delivery_date' => $request -> delivery_date,
                'id_user' => $request -> id_user,
            ]);

            return response()->json(['message' => 'Order created successfully']);
            
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {

        $order = Order::where('id', $id);

        if (!$order) {
            return response()->json(['error' => 'User not found']);
        }

        $order -> update([
            'state' => $request -> state
        ]);

        return response()->json(['message' => 'Order update successfully']);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
