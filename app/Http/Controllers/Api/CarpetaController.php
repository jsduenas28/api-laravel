<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Carpeta;

class CarpetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $carpeta = Carpeta::where('usuario', $user->id)->get();
        return $carpeta;
    }

    public function carpetaNota() {
        $user = auth()->user();
        $carpetasConNotas = Carpeta::where('usuario', $user->id)->with('notas')->get();

        return $carpetasConNotas;
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $carpeta = new Carpeta();
        $carpeta->nombre_carpeta = $request->nombre_carpeta;
        $carpeta->color_carpeta = $request->color_carpeta;
        $carpeta->usuario = $user->id;

        $carpeta->save();

        return response()->json(['message' => 'Carpeta creada correctamente', 'data' => $carpeta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $carpeta = Carpeta::where('id', $id)->get();

        return $carpeta;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = auth()->user();
        $carpeta = Carpeta::findOrFail($request->id);

        $carpeta->nombre_carpeta = $request->nombre_carpeta;
        $carpeta->color_carpeta = $request->color_carpeta;
        $carpeta->usuario = $user->id;

        $carpeta->save();

        // Respuesta JSON con los datos actualizados
        return response()->json(['message' => 'Carpeta actualizada correctamente', 'data' => $carpeta]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $carpeta = Carpeta::where('id', $id)->delete();
        return response()->json(['message' => 'Carpeta eliminada correctamente', 'data' => $carpeta]);
    }
}
