<?php

namespace App\Http\Controllers;

use App\Models\OrigenLlamada;
use Illuminate\Http\Request;

class OrigenLlamadaController extends Controller
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
                'data' => OrigenLlamada::orderBy('id', 'desc')->paginate(15),
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
            'origen_llamada' => 'required|string',
        ]);

        try {
            $origenLlamada = new OrigenLlamada($request->all());
            $origenLlamada->save();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de Llamada creado correctamente.',
                'data' => $origenLlamada,
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
     * @param  \App\Models\OrigenLlamada  $origenLlamada
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $origenLlamada = OrigenLlamada::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $origenLlamada,
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
     * @param  \App\Models\OrigenLlamada  $origenLlamada
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'origen_llamada' => 'required|string',
        ]);

        try {
            $origenLlamada = OrigenLlamada::find($id);
            $origenLlamada->origen_llamada = $request->origen_llamada;
            $origenLlamada->update();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de Llamada atualizado correctamente.',
                'data' => $origenLlamada,
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
     * @param  \App\Models\OrigenLlamada  $origenLlamada
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $origenLlamada = OrigenLlamada::find($id);
            $origenLlamada->delete();

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
