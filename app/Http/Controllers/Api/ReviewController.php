<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Review::all();
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
            'comment'=>'required|string|max:25',
            'qualification'=>'required|integer|max:5|min:0',
            'id_user'=>'required|exists:users,id',
            'id_product'=>'exists:product,id',
            'id_ability'=>'exists:ability,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación.',
                'error' => $validator->errors()
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $review = Review::create($validator->validate());
        return response()->json([
            'message' => 'Reseña creada con exito.',
            // 'review' => $review
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $revi = Review::find($id);
        if (!$revi) {
            return response()->json(['error' => 'Reseña no encontrada.'],Response::HTTP_NOT_FOUND);
        }
        $review = array(
            'comment' => $revi->comment,
            'qualification' => $revi->qualification,
            'id_user' => $revi->id_user,
            'id_product' => $revi->id_product,
            'id_ability' => $revi->id_ability,
        );
        return response()->json($review);
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
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['error' => 'Reseña no encontrada.'],Response::HTTP_NOT_FOUND);
        }

        $validator = Validator::make($request->all(),[
            'comment' => 'required|string|max:25',
            'qualification' => 'required|integer|max:5|min:0',
            // 'id_user' => 'required|exists:users,id',
            // 'id_product' => 'required|string|max:25',
            // 'id_ability' => 'required|string|max:25',
        ]);
        if ($validator -> fails()) {
            return response()->json([
                'message' => 'Error de validación.',
                'error' => $validator->errors()
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $review -> update($validator->validate());
        return response()->json(['message'=> 'Reseña actualizada con exito.'],Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['error' => 'Reseña no encontrada.'],Response::HTTP_NOT_FOUND);
        }
        $review -> delete();
        return response()->json(['message' => 'Reseña eliminada correctamente.'],Response::HTTP_OK);
    }
}
