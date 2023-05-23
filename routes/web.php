<?php

use App\Http\Controllers\DocTypeController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ReserveController;

use Illuminate\Support\Facades\Route;

// :::::::::::::Rutas de navegacion:::::::::::::

// (ruta(url),vitsa(a devolver))->nombre ruta(como se va a llamar)
//hotelTest.test => Welcome
Route::view('/', "welcome")->name('inicio');
//hotelTest.test => reserve
Route::view('/reservar', "reserve")->name('reservar');
//hotelTest.test => check-schedule
Route::view('/consultar-agenda', "check-schedule")->name('consultar-agenda');
//hotelTest.test => waiting-customers
Route::view('/clientes-espera', "waiting-customers")->name('clientes-espera');
//hotelTest.test => crud doctypes
Route::view('/crud-tipos-documentos', "crud-doctype")->name('crud-tipos-documentos');


// :::::::::::::Controladores:::::::::::::

// DocType Controllers
//hotelTest.test => controller DocTypes-get-all
Route::get('/documentsTypes', [DocTypeController::class, 'returnTypesDocs']);
//hotelTest.test => controller DocTypes-create
Route::post('/documentsTypes', [DocTypeController::class, 'createTypeDoc']);
//hotelTest.test => controller DocTypes-Delete
Route::delete('/documentsTypes/{id}', [DocTypeController::class, 'deleteTypeDoc']);
//hotelTest.test => controller DocTypes-update
Route::put('/documentsTypes/{id}', [DocTypeController::class, 'updateTypeDoc']);
//hotelTest.test => controller States-get-all
Route::get('/states', [StateController::class, 'returnStates']);


// Client Crontollers
Route::post('/client', [ClientController::class, 'searchClient']);
Route::post('/create-client', [ClientController::class, 'createClient']);
Route::put('/client/{id}', [ClientController::class, 'updateClient']);
Route::post('/check-document', [ClientController::class, 'checkDocument']);
Route::post('/check-email', [ClientController::class, 'checkEmail']);

// Room Crontollers
Route::get('/returnRooms', [RoomController::class, 'returnRooms']);

// Reserve Crontollers
Route::get('/loadEmployees', [EmployeeController::class, 'returnEmployees']);
Route::post('/reservations', [ReserveController::class, 'checkAvailability']);
Route::get('/returnReserves', [ReserveController::class, 'returnReserves']);
Route::post('/changeDates', [ReserveController::class, 'changeDates']);
Route::get('/returnActivesReserves', [ReserveController::class, 'returnActiveReserves']);
Route::put('/desactiveReserve/{id}', [ReserveController::class, 'desactiveReserve']);
Route::post('/filterReserves', [ReserveController::class, 'filterReserves']);