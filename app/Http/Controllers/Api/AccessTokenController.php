<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AccessTokenController extends Controller
{
    public function validarToken() {
        //validación
        $user = auth()->user();

        if ($user == null) {
            return response()->json(['token' => 0]);
        }

        return response()->json(['token' => 1]);
    }
}
