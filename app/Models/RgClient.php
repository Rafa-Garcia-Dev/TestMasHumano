<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RgClient extends Model
{
    use HasFactory;
       protected $table = 'rgclient';
       protected $fillable = ['name', 'lastName', 'idDocType', 'docnumber', 'email', 'birthdate'];
       public function docType()
       {
           return $this->belongsTo(RgDocType::class, 'idDocType');
       }

}
