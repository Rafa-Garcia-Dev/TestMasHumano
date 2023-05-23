<?php

namespace App\Http\Controllers;
use App\Models\RgEmployee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function returnEmployees()
    {
        $valores = RgEmployee::all(['id', 'name']);
        
        return response()->json($valores);
    }
   
}