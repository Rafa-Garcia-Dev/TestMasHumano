<?php

namespace App\Http\Controllers;
use App\Models\RgClient;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Controlador para retornar todos los estados disponibles
    public function searchClient(Request $request)
    {
        $idDocType = $request->input('idDocType');
        $docnumber = $request->input('docnumber');
        $cliente = RgClient::where('idDocType', $idDocType)
                            ->where('docnumber', $docnumber)
                            ->first();
    
        if ($cliente) {
            return response()->json([$cliente]);
        } else {
            return response()->json([]);
        }
    }
    // Controlador para actualizar el cliente
    public function updateClient(Request $request, $id)
    {
        try {
            $client = RgClient::findOrFail($id);
            $client->name = $request->input('name');
            $client->lastName = $request->input('lastName');
            $client->idDocType = $request->input('idDocType');
            $client->docnumber = $request->input('docnumber');
            $client->email = $request->input('email');
            $client->birthdate = $request->input('birthdate');
            
            $client->save();
    
            return response()->json([
                'success' => true,
                'data' => $client 
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    // Controlador validar si existe el tipo de documento
    public function checkDocument(Request $request)
    {
        $idDocType = $request->input('idDocType');
        $docnumber = $request->input('docnumber');
        
        $client = RgClient::where('idDocType', $idDocType)
                            ->where('docnumber', $docnumber)
                            ->first();

        if ($client) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
    // Controlador validar si existe el email
    public function checkEmail(Request $request)
    {
        $email = $request->input('email');
        
        $client = RgClient::where('email', $email)
                            ->first();

        if ($client) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
    // Controlador validar si existe el email
    public function createClient(Request $request)
    {
        try {
            $client = new RgClient();
            $client->name = $request->input('name');
            $client->lastName = $request->input('lastName');
            $client->idDocType = $request->input('idDocType');
            $client->docnumber = $request->input('docnumber');
            $client->email = $request->input('email');
            $client->birthdate = $request->input('birthdate');

            $client->save();

            return response()->json([
                'success' => true,
                'data' => $client
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}