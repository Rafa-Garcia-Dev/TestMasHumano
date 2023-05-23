<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RgRoom extends Model
{
    use HasFactory;
            protected $table = 'rgroom';
            protected $fillable = ['name', 'idState','capacity', 'observation'];
            public function estado()
            {
                return $this->belongsTo(RgState::class, 'idState');
            }
}
