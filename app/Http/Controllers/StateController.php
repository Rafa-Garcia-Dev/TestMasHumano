<?php

namespace App\Http\Controllers;

use App\Models\RgState;
use Illuminate\Http\Request;

class StateController extends Controller
{
    // Controlador para retornar todos los estados disponibles
    public function returnStates()
    {               
            $valores = RgState::all();
            return response()->json($valores);      
    }
 
}

