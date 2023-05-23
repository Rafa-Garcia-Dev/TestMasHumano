<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RgDocType extends Model
{
    use HasFactory;
        protected $table = 'rgdoctypes';
        protected $fillable = ['value', 'description','idState', 'observation'];
        public function estado()
        {
            return $this->belongsTo(RgState::class, 'idState');
        }
}
