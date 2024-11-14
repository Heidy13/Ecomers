<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cart;
use App\Models\Cart_detail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\Token;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function register(Request $request)
    {

        // try {

            $field = $request -> validate([
                'name' => 'required',
                'email'=> 'required|email',
                'password'=> 'required',
                'phone'=> 'required',
                'location'=> 'required',
                'date_register'=> now(),
            ]); 

            $user = User::create($field);

            // $register = User::create([
            //     'name' => $request->name,
            //     'email' => $request->email,
            //     'password' => Hash::make($request['password']),
            //     'phone' => $request->phone,
            //     'location' => $request->location,
            //     'date_register' => now()
            // ]);



            return response()->json($user);
        // } catch (Exception $e) {
        //     return response()->json(['error' => 'An error occurred: ' . $e->getMessage()]);
        // }
    }

    public function login(Request $request)
    {

        try {

            $request->validate([
                'email' => 'string|email',
                'password' => 'string'
            ]);

            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return response()->json(['error' => 'the email not foud']);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json(['error' => 'the password is incorrect']);
            }

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

    public function update (Request $request, $id) {

        try {

            $user = User::where('id', $id);
            if (!$user) {
                 return response()->json(['error' => 'User not fount']);
            }

            $user -> update([
                'name' => $request ->name,
                'email' => $request ->email,
                'password' => Hash::make($request['password']),
                'phone' => $request ->phone,
                'location' => $request ->location,
            ]);
        return response()->json(['message' => 'User update correct: ']);

        } catch (Exception $e) {
            return response()->json(['error' => 'An error ocurrerd: '.$e->getMessage()]);
        }
    }

    public function logout (Request $request) {

        $user = $request ->user();

        if ($user) {
            $token = $request->bearerToken();
            $tokenModel = Token::where('id',$token)->first();

            if ($tokenModel) {
                $tokenModel->delete();
                return response()->json(['message' => 'Successfully logged out']);
            }
            return response()->json(['message' => 'Token not found']);
        }
        return response()->json(['message' => 'User not found']);
    }

    public function createCart(Request $request){

    try {
        $cart = Cart::create([
            'amount'=>$request->input('amount'),
            'date_added'=>$request->input('date_added'),
            'id_user'=>$request->input('id_user'),
            'id_product'=>$request->input('id_product')
        ]);

        return response()->json(['message'=>'Carrito creado con exito', $cart], 200);

    } catch (Exception $e) {
        return response()->json(['error'=>'error:'.$e->getMessage()]);
    }
    }
}
