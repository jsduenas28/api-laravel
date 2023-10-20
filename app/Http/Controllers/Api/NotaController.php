<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $nota = Nota::where('carpeta', $id)->get();

        return $nota;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nota = new Nota();
        $nota->titulo_nota = $request->titulo_nota;
        $nota->contenido_nota = $request->contenido_nota;
        $nota->carpeta = $request->carpeta;

        $nota->save();

        return response()->json(['message' => 'Nota creada con exito', 'data' => $nota]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $nota = Nota::where('id', $id)->get();

        return $nota;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $nota = Nota::findOrFail($request->id);
        $nota->titulo_nota = $request->titulo_nota;
        $nota->contenido_nota = $request->contenido_nota;
        $nota->carpeta = $request->carpeta;

        $nota->save();

        return response()->json(['message' => 'Nota actualizada con exito', 'data' => $nota]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $nota = Nota::where('id', $id)->delete();

        return response()->json(['message' => 'Nota eliminada con exito', 'data' => $nota]);
    }
}
