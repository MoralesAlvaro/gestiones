<?php

namespace App\Http\Controllers;

use App\Models\TipoLlamada;
use Illuminate\Http\Request;

class TipoLlamadaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'success' => true ,
                'data' => TipoLlamada::orderBy('id', 'desc')->paginate(15),
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Inaccesible.',
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tipo_llamada' => 'required|string',
        ]);

        try {
            $tipoLlamada = new TipoLlamada($request->all());
            $tipoLlamada->save();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de Llamada creado correctamente.',
                'data' => $tipoLlamada,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Inaccesible.',
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoLlamada  $tipoLlamada
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $tipoLlamada = TipoLlamada::findOrFaild($id);
            return response()->json([
                'success' => true,
                'data' => $tipoLlamada,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Inaccesible.',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoLlamada  $tipoLlamada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tipo_llamada' => 'required|string',
        ]);

        try {
            $tipoLlamada = TipoLlamada::find($id);
            $tipoLlamada->tipo_llamada = $request->tipo_llamada;
            $tipoLlamada->update();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de Llamada atualizado correctamente.',
                'data' => $tipoLlamada,
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Inaccesible.',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoLlamada  $tipoLlamada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $tipoLlamada = TipoLlamada::find($id);
            $tipoLlamada->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de Llamada eliminado correctamente.',
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Inaccesible.',
            ], 404);
        }
    }
}
