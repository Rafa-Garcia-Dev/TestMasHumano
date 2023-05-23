<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RgEmployee extends Model
{
    use HasFactory;
    protected $table = 'rgemployee';
     protected $fillable = ['value', 'name','lastName', 'idDocType', 'docnumber','idRol', 'birthdate'];
}
