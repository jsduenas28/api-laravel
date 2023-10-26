<?php

namespace App\Http\Controllers\Api;

use App\Models\Nota;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BusquedaController extends Controller
{
    public function busquedaCarpeta($id) {
        $user = auth()->user();

        $nota = Nota::join('carpeta', 'nota.carpeta', '=', 'carpeta.id')
                    ->where('carpeta.usuario', '=', $user->id)
                    ->where('nota.carpeta', '=', $id)
                    ->select('nota.*')
                    ->get();

        return $nota;
    }

    public function busquedaPalabraClave(Request $request) {
        $palabra = $request->palabra;
        $user = auth()->user();

        $nota = Nota::join('carpeta', 'nota.carpeta', '=', 'carpeta.id')
                    ->where('carpeta.usuario', '=', $user->id)
                    ->where(function ($query) use ($palabra) {
                        $query->where('nota.titulo_nota', 'like', '%'. $palabra .'%');
                    })
                    ->select('nota.*')
                    ->get();

        return $nota;
    }

    public function busquedaFecha(Request $request) {
        $fecha = $request->fecha;
        $user = auth()->user();

        $nota = Nota::join('carpeta', 'nota.carpeta', '=', 'carpeta.id')
                    ->where('carpeta.usuario', '=', $user->id)
                    ->whereDate('nota.updated_at', '=', $fecha)
                    ->select('nota.*')
                    ->get();

        return $nota;
    }
}
