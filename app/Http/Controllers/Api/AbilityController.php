<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class AbilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Ability::all('name');
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
            'name' => 'required|string|max:25|unique:ability,name',
            'description' => 'required|string|max:35',
            'id_user' => 'required|exists:users,id'
        ]);
        if ($validator -> fails()) {
            return response([
                'message'=>'Error de Validación.',
                'error' => $validator->errors()
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $ability = Ability::create($validator->validate());
        return response([
            'message'=>'Habilidad creada con exito.',
            'ability'=>$ability
            ],Response::HTTP_CREATED);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $abi = Ability::find($id);
        if (!$abi) {
            return response(['error'=>'Habilidad no encontrada.'],Response::HTTP_NOT_FOUND);
        }
        $ability = array(
            'name' => $abi->name,
            'description'=>$abi->description
        );
        return response()->json($ability);
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
        $ability = Ability::find($id);
        if (!$ability) {
            return response()->json(['error' => 'Habilidad no encontrada.'],Response::HTTP_NOT_FOUND);
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:25|unique:ability,name,' . $id,
            'description' => 'required|string|max:35'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'error' => $validator->errors()
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $ability->update($validator->validate());
        return response()->json(['message' => 'Habilidad actualizada con exito.']);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $ability = Ability::find($id);
        if (!$ability) {
            return response()->json(['error' => 'Habilidad no encontrada.'],Response::HTTP_NOT_FOUND);
        }
        $ability ->delete();
        return response()->json(['message'=>'Habilidad eliminada correctamente.'],Response::HTTP_OK);
    }
}
