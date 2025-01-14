<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Category::all('name');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25|unique:category,name',
            'description' => 'required|string|max:45',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación.',
                'error' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $category = Category::create($validator->validate());
        return response()->json([
            'message' => 'Categoria creada con exito.',
            // 'categoty' => $category
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $cate = Category::find($id);
        if (!$cate) {
            return response()->json(['error' => 'Categoria no encotrada',], Response::HTTP_NOT_FOUND);
        }
        $category = array(
            'name' => $cate->name,
            'description' => $cate->description,
        );
        return response()->json($category);
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
        $cate = Category::find($id);
        if (!$cate) {
            return response()->json(['error' => 'Categoria no encontrada.'], Response::HTTP_NOT_FOUND);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:25|unique:category,name,' . $id,
            'description' => 'required|string|max:45',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validacion',
                'error' => $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $cate->update($validator->validate());
        return response()->json(['message' => 'Categoria actualizada con exito.']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $cate = Category::find($id);
        if (!$cate) {
            return response()->json(['error' => 'Categoria no encontrada.'],Response::HTTP_NOT_FOUND);
        }
        $cate -> delete();
        return response()->json(['message' => 'Categoria eliminada correctamente.']);
    }
}
