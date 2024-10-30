<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use Exception;
use Illuminate\Http\Request;

class AbilityController extends Controller
{
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
        try {
            
            $ability = Ability::create([
            'name' => $request -> name,
            'description' => $request -> description,
            'creation_date' => now(),
            'id_user' => $request -> id_user,
        ]);

        return response()->json(['message' => 'Ability created successfully']);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }

        
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
