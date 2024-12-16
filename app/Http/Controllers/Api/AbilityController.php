<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Service\FuncionService;
use Exception;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
    private $service;
    public function __construct(FuncionService $service){
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $ability = Ability::all('name');
        return $ability;
    }

    public function store(Request $request)
    {
        $id_craftsman = $this->service->obtenerIdArtesanoAutenticado();
        if (!$id_craftsman) {
            return response()->json(['error' => 'User not authenticated']);
        }

        $field = $request -> validate([
            'name' => 'required|string|max:25|unique:ability',
            'description' => 'required|string|max:50',
            'create_date' => now(),
            'id_user' => 'required|unique:users,id'
         ]);

        // $field['create_date'] = now();
        // $field['id_user'] = $id_craftsman;

         $ability = Ability::create($field);
         return response()->json($ability);   
    }

    public function update(Request $request, string $id)
    {
        try {

            $ability = Ability::where('id',$id);
            if (!$ability) {
                return response()->json(['error' => 'User not found']);
            }

            $ability -> update([
                'name' => $request -> name,
                'description' => $request -> description
            ]);

            return response()->json(['message' => 'Ability update successfully']);

        } catch (Exception $e) {
            return response()->json(['An error ocurrerd: '.$e->getMessage()]);
        }
    }

    public function show ($id) {
        try {

            $ability = Ability::where('id_user', $id)->select('id','name')->get();
            return $ability;

        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocirrerd: '.$e->getMessage()]);
        }
    }
 
}
