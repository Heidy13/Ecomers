<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        try {
            // $register = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => Hash::make($request['password']),
            //     'phone' => $request->iphone,
            //     'location' => $request->location,
            //     'date_register' => now()
            // ]);

            // return response()->json($register);
           $filds = $request->validate([
                'name' => 'required|string',
                'email' => 'required|email',
                'password' => 'required',
                'phone' => 'required|integer',
                'location' => 'required|string',
            ]);
            $filds['date_register'] = Carbon::now()->format('Y-m-d');

            $user = User::create($filds);
            return response()->json([
                $user
            ]);
           
            





        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        }
    }

    public function login(Request $request)
    {

        try {

            $request->validate([
                'email' => 'required|email|exists:users',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json(['messsage' => 'Unauthorized']);
            }
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            $aditionalInfo = $this->getAdditionalInfo($user);

            return response()->json([
                'acces_token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'user' => $aditionalInfo
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: ' . $e->getMessage()]);
        }
    }

    protected function getAdditionalInfo($user)
    {
        $info = [];

        $info = [
            'id' => $user->id,
            'name' => $user->name,
            'rol' => $user->role
        ];
        
        return $info;
    }

}
