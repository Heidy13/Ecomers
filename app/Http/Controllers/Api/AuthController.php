<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $filds = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => Hash::make(['required', Password::defaults()]),
            'phone' => 'required|integer|min:1|max:10',
            'location' => 'required|string',
        ]);
        $filds['date_register'] = Carbon::now()->format('Y-m-d');

        $user = User::create($filds);
        return Response::HTTP_CREATED;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['messsage' => 'Unauthorized']);
        }
        $user = $request->user();
        $tokenResult = $user->createToken($user->role);
        $token = $tokenResult->token;
        $token->save();

        $aditionalInfo = $this->getAdditionalInfo($user);

        return response()->json([
            'acces_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'user' => $aditionalInfo
        ]);
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

    public function logout(Request $request)
    {
        $request->user()->token()->delete();
        return Response::HTTP_OK;
    }
}
