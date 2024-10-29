<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register (Request $request) {

        try {
            $register = User::create([
            'name' => $request -> name,
            'email' => $request -> email,
            'password' => Hash::make($request['password']),
            'phone' => $request -> iphone,
            'location' => $request -> location,
            'date_register' => now()
        ]);

        return response()->json($register);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' .$e ->getMessage()]);
        }
    }

    public function login (Request $request) {

        try {

            $request -> validate([
                'email' => 'string|email',
                'password' => 'string'
            ]);

            // $user = User::where('email', $request->email)->with('user')->first();
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['error' => 'the email not foud']);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'the password is incorrect']);
            }

            $tokenResult = $user->createToken('Personal Access Token');
            // $token = $tokenResult->token;
            $token = $tokenResult -> plainTextToken;
            // $token -> save();

            // $aditionalInfo = $this->getAdditionalInfo($user);

            return response()->json([
                // 'acces_token' => $tokenResult->accesToken,
                'acces_token' => $token,
                'token_type' => 'Bearer',
                // 'user' => $aditionalInfo
            ]);
            
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: ' .$e ->getMessage()]);
        }
    }

    protected function getAdditionalInfo ($user) {
        $info = [];
        $user ->$info = [
            'id' => $user->id,
            'name' => $user->name,
        ];
        return $info;
    }


 

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
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
