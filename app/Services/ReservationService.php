<?php
namespace App\Services;

use App\Models\RgReserve;
use App\Models\RgWaitinClient;

class ReservationService
{
    public function checkAvailability($roomId, $startDate, $endDate)
    {
        $reservations = RgReserve::where('idRoom', $roomId)
            ->where(function ($query) use ($startDate, $endDate) {
                $query->where(function ($query) use ($startDate, $endDate) {
                    $query->where('startDate', '>=', $startDate)
                        ->where('startDate', '<=', $endDate);
                })
                ->orWhere(function ($query) use ($startDate, $endDate) {
                    $query->where('endDate', '>=', $startDate)
                        ->where('endDate', '<=', $endDate);
                });
            })
            ->get();
    
        if ($reservations->count() > 0) {
            return ['success' => false, 'message' => 'La habitación no está disponible en las fechas seleccionadas.'];
        }
    
        return ['success' => true];
    }

    public function createReservation($roomId, $startDate, $endDate, $clientId, $employeeId)
    {
        
        if (empty($roomId) || empty($startDate) || empty($endDate) || empty($clientId) || empty($employeeId)) {
            return ['success' => false, 'message' => 'Todos los campos son obligatorios.'];
        }
        
        $daysNumber = (strtotime($endDate) - strtotime($startDate)) / (60 * 60 * 24);

        
        $reservation = new RgReserve();
        $reservation->idRoom = $roomId;
        $reservation->daysNumber = $daysNumber;
        $reservation->startDate = $startDate;
        $reservation->endDate = $endDate;
        $reservation->idClient = $clientId;
        $reservation->idState = 1; 
        $reservation->idEmployee = $employeeId;
        $reservation->save();
  
        return ['success' => true, 'message' => 'Reserva creada exitosamente.'];
    }

    public function updateReservationDates($idReserva, $newStartDate, $newEndDate)
    {
        $daysNumber = (strtotime($newEndDate) - strtotime($newStartDate)) / (60 * 60 * 24);
        $reserva = RgReserve::find($idReserva);

        if (!$reserva) {
            return ['success' => false, 'message' => 'Reserva no encontrada.'];
        }

        $roomId = $reserva->idRoom;
        $availability = $this->checkAvailability($roomId, $newStartDate, $newEndDate);

        if (!$availability['success']) {
            return ['success' => false, 'message' => $availability['message']];
        }

        $reserva->startDate = $newStartDate;
        $reserva->endDate = $newEndDate;
        $reserva->daysNumber = $daysNumber;
        $reserva->save();

        return ['success' => true, 'message' => 'Fechas de reserva actualizadas con éxito.'];
    }

    public function createWaitingClient($roomId, $startDate, $endDate, $clientId)
{
    $waitingClient = new RgWaitinClient();
    $waitingClient->idRoom = $roomId;
    $waitingClient->startDate = $startDate;
    $waitingClient->endDate = $endDate;
    $waitingClient->idClient = $clientId;
    $waitingClient->save();

    return $waitingClient;
}
}