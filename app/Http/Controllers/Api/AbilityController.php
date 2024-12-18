<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
            $filds = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string|max:50',
            'id_user' => ['required', 'exists:users,id'],
        ]);
        $filds['creation_date'] = Carbon::now()->format('Y-m-d');

        $ability = Ability::create($filds);
        // return response()->json($ability);
        return Response::HTTP_CREATED; 
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


    public function destroy ($id) {

        $ability = Ability::find($id);

        if (!$ability) {
            return Response::HTTP_NOT_FOUND;
        }
        $ability->delete();
        return Response::HTTP_OK;
    }
 
}
