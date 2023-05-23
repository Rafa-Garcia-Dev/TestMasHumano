<?php

namespace App\Http\Controllers;
use App\Models\RgRoom;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function returnRooms()
    {
        $valores = RgRoom::with('estado')->get();
    
        // Obtener solo el nombre del estado en lugar del objeto completo
        $valores->transform(function ($item) {
            $item->estado = $item->estado->name;
            return $item;
        });
    
        return response()->json($valores);
    }
}