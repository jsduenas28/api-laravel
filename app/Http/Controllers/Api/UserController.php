<?php

namespace App\Http\Controllers\Api;

use \stdClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User
     */
    public function index() {
        $user = auth()->user();

        return response()->json(['data' => $user]);
    }

    public function registerUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['data' => $user, 'accessToken' => $token, 'token_type' => 'Bearer']);
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::validate($credentials)) {
            if ($user = Auth::getLastAttempted()) {
                Auth::login($user);
                $token = $user->createToken('auth_token')->plainTextToken;

                return response()->json([
                    'message' => 'Hola '.$user->name,
                    'accessToken' => $token,
                    'token_type' => 'Bearer',
                    'user' => $user
                ]);
            }
        }

        return response()->json([
            'message' => 'Inicio de sesión fallido. Verifica tus credenciales e intenta nuevamente.'
        ], 401); // Código 401 para "No autorizado"
    }

    public function logoutUser() {
        auth()->user()->tokens()->delete();

        return [
            'message'=>'Cessión cerrada'
        ];
    }
}
