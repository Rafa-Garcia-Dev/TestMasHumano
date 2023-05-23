<?php
namespace App\Services;

use App\Models\RgRoom;

class RoomService
{
    public function checkCapacity($capacity)
    {
        $room = RgRoom::where('capacity', $capacity)
            ->where('idState',1)
            ->first();
    
        if (!$room) {
            return ['success' => false, 'message' => 'No existe una habitación activa disponible para ese número de personas.'];
        }
        return ['success' => true, 'room' => $room];
    }
}