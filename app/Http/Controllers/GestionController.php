<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Illuminate\Http\Request;
use App\Http\Resources\Gestion as GestionResources;
use App\Http\Resources\GestionCollection;

class GestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return new GestionCollection(Gestion::orderBy('id', 'desc')->paginate(15));
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
            'tipo_llamada_id' => 'required|integer',
            'origen_llamada_id' => 'required|integer',
            'nombre' => 'required|string',
            'telefono' => 'required|max:8',
            'gestion' => 'required|string',
        ]);

        try {
            $gestion = new Gestion($validated);
            $gestion->save();

            return response()->json([
                'success' => true,
                'message' => 'Tipo de Llamada creado correctamente.',
                'data' => $gestion,
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
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $gestion = Gestion::findOrFail($id);
            return response()->json([
                'success'=> false,
                'data' => new GestionResources($gestion),
            ], 200);
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
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tipo_llamada_id' => 'required|integer',
            'origen_llamada_id' => 'required|integer',
            'nombre' => 'required|string',
            'telefono' => 'required|max:8',
            'gestion' => 'required|string',
        ]);

        try {
            $gestion = Gestion::find($id);
            $gestion->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Tipo de Llamada creado correctamente.',
                'data' => $gestion,
            ], 201);
        } catch (\Throwable $th) {
            // return $th->getMessage();
            return response()->json([
                'success' => false,
                'message' => 'Inaccesible.',
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gestion  $gestion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $gestion = Gestion::find($id);
            $gestion->delete();

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
