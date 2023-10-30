<?php

namespace App\Http\Controllers\Api;

use App\Models\Nota;
use Illuminate\Http\Request;
use App\Models\ResEstadisticos;
use App\Http\Controllers\Controller;

class ResEstadisticosController extends Controller
{
    public function index() {
        $user = auth()->user();
        $resEstadistico = ResEstadisticos::where('usuario', $user->id)->get();

        return $resEstadistico;
    }

    public function store(Request $request) {
        $user = auth()->user();
        $res = new ResEstadisticos();

        // Obtén la Nota correspondiente
        $nota = Nota::find($request->nota_id);

        // Asegúrate de que la Nota existe
        if ($nota) {
            $res->titulo_nota = $nota->titulo_nota;
        }

        $res->resultados = json_encode($request->resultados);
        $res->nota_cuestionario = $request->nota_cuestionario;
        $res->usuario = $user->id;

        $res->save();

        return response()->json(['message' => 'Resultados guardado', 'data' => $res]);
    }

    public function cuestionario($id) {
        $cuestionario = ResEstadisticos::where('id', $id)->get();

        return $cuestionario;
    }

    public function delete($id) {
        $cuestionario = ResEstadisticos::where('id', $id)->delete();

        return response()->json(['message' => 'Cuestionario eliminado con exito', 'data' => $cuestionario]);
    }
}
