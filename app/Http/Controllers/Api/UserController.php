<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {
        $field = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'phone' => 'required',
            'location' => 'required',
            'date_register' => now(),
        ]);
        $user = User::create($field);
        return response()->json($user);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $credentials = request(['email','password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            
            $token = $tokenResult->token;
            if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            // return response()->json([
            //     'id' => $user->id,
            //     'access_token' => $tokenResult->accessToken,
            //     'name' => $user->name,
            //     'email' => $user->email,
            //     "rol" => $user->getRoleNames(),
            //     'token_type' => 'Bearer',
            //     'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
            // ]);

        // $user = User::where('email', $request->email)->first();

        // if (!$user || ! Hash::check($request->password, $user->password)) {
        //     return [
        //         'errors' => [
        //             'email' => [
        //                 'The provided credentials are incorrect'
        //             ]
        //         ]
        //     ];
        // }

        // $token = $user->createToken($user->name);

        // return [
        //     'user' => $user,
        //     'token' => $token->plainTextToken
        // ];
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

    public function update(Request $request, $id)
    {

        try {
            $user = User::where('id', $id);
            if (!$user) {
                return response()->json(['error' => 'User not fount']);
            }
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request['password']),
                'phone' => $request->phone,
                'location' => $request->location,
            ]);
            return response()->json(['message' => 'User update correct: ']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: ' . $e->getMessage()]);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

        return [
            'message' => 'You are logged out.'
        ];
        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    public function createCart(Request $request)
    {

        try {
            $cart = Cart::create([
                'amount' => $request->input('amount'),
                'date_added' => $request->input('date_added'),
                'id_user' => $request->input('id_user'),
                'id_product' => $request->input('id_product')
            ]);

            return response()->json(['message' => 'Carrito creado con exito', $cart], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'error:' . $e->getMessage()]);
        }
    }
}
