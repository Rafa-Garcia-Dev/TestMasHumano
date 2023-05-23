<?php

namespace App\Http\Controllers;
use App\Models\RgReserve;
use App\Services\RoomService;
use App\Services\ReservationService;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    protected $roomService;
    protected $reservationService;

    public function __construct(RoomService $roomService, ReservationService $reservationService)
    {
        $this->roomService = $roomService;
        $this->reservationService = $reservationService;
    }
    // Controlador para crear la reserva
    public function checkAvailability(Request $request)
    {
        $capacity = $request->input('capacity');
        $room = $this->roomService->checkCapacity($capacity);

        if (!$room['success']) {
            return response()->json(['success' => false, 'message' => $room['message']]);
        }
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $reservation = $this->reservationService->checkAvailability($room['room']->id, $startDate, $endDate);
      
        if (!$reservation['success']) {
            // No se puede hacer una reserva, crear un cliente en espera
            $createWaitingClient = $this->reservationService->createWaitingClient(
                $room['room']->id,
                $startDate,
                $endDate,
                $request->input('clientId')
            );
    
            if (!$createWaitingClient['success']) {
                return response()->json(['success' => false, 'message' => $createWaitingClient['message']]);
            }
    
            return response()->json(['success' => false, 'message' => $reservation['message']]);
        }
        $createReservation = $this->reservationService->createReservation(
            $room['room']->id,
            $startDate,
            $endDate,
            $request->input('clientId'),
            $request->input('employeeId')
        );
    
        if (!$createReservation['success']) {
            return response()->json(['success' => false, 'message' => $createReservation['message']]);
        }
    
        return response()->json(['success' => true, 'message' => $createReservation['message']]);
    }
    // Controlador para actualizar la reserva
    public function changeDates(Request $request)
    {
        $reservationId = $request->input('id');
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $updateReservation = $this->reservationService->updateReservationDates($reservationId, $startDate, $endDate);

        if (!$updateReservation['success']) {
            return response()->json(['success' => false, 'message' => $updateReservation['message']]);
        }

        return response()->json(['success' => true, 'message' => 'Reserva actualizada correctamente.']);
    }
    // Controlador para retornartodas las reservas
    public function returnReserves()
    {
    $valores = RgReserve::with('room', 'client', 'estado', 'employee')->get();

    $valores->transform(function ($item) {
        $item->estado = $item->estado->name;
        return $item;
    });

    return response()->json($valores);
    }  

    public function returnActiveReserves()
    {
        $valores = RgReserve::with('room', 'client', 'estado', 'employee')
                            ->where('idState', 1)
                            ->get();

        $valores->transform(function ($item) {
            $item->estado = $item->estado->name;
            return $item;
        });

        return response()->json($valores);
    }

    public function desactiveReserve($reserveId)
    {
        $reserve = RgReserve::find($reserveId);

        if (!$reserve) {
            return response()->json(['success' => false, 'message' => 'Reserva no encontrada.']);
        }

        $reserve->idState = 2;
        $reserve->save();
        return response()->json(['success' => true, 'message' => 'Reserva desactivada correctamente.']);
    }

    public function filterReserves(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
      
        $reserves = RgReserve::with('room', 'client', 'estado', 'employee')
                            ->where('idState', 1)
                            ->whereBetween('startDate', [$startDate, $endDate])
                            ->get();
      
        $reserves->transform(function ($item) {
          $item->estado = $item->estado->name;
          return $item;
        });
      
        return response()->json($reserves);
      }
}

