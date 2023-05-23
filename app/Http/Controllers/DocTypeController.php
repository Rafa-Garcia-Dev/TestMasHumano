<?php

namespace App\Http\Controllers;

use App\Models\RgDocType;
use Illuminate\Http\Request;

class DocTypeController extends Controller
{
    // Controlador para retornar todos los tipos de documentos
    public function returnTypesDocs()
    {
        $valores = RgDocType::with('estado')->get();
    
        // Obtener solo el nombre del estado en lugar del objeto completo
        $valores->transform(function ($item) {
            $item->estado = $item->estado->name;
            return $item;
        });
    
        return response()->json($valores);
    }
    // Controlador crear un nuevo tipo de documento
    public function createTypeDoc(Request $request)
    {
    //    print_r($token = $request->session()->token()) ;
    //   echo($request) ;

        $request->validate([
        'value' => 'required',
        'description' => 'required',
        'idState' => 'required',
        'observation' => 'required',
        ]);

    try {
        $newTypeDoc = RgDocType::create([
            'value' => $request->input('value'),
            'description' => $request->input('description'),
            'idState' => $request->input('idState'),
            'observation' => $request->input('observation'),
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
    }
    // Controlador eliminar un tipo de documento
    public function deleteTypeDoc($id)
    {
    try {
        $typeDoc = RgDocType::findOrFail($id);
        $typeDoc->delete();
        
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
    }
    // Controlador actualizar un tipo de documento
    public function updateTypeDoc(Request $request, $id)
    {
    try {
        $typeDoc = RgDocType::findOrFail($id);
        $typeDoc->value = $request->input('value');
        $typeDoc->description = $request->input('description');
        $typeDoc->idState = $request->input('idState');
        $typeDoc->observation = $request->input('observation');
        $typeDoc->save();
        
        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json(['success' => false, 'error' => $e->getMessage()]);
    }
    }
}

