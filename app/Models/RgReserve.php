<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RgReserve extends Model
{
    use HasFactory;
    protected $table = 'rgreserve';
    protected $fillable = ['idRoom', 'daysNumber', 'startDate', 'endDate', 'idClient', 'idState', 'idEmployee'];

    public function room()
        {
            return $this->belongsTo(RgRoom::class, 'idRoom');
        }
        public function client()
        {
            return $this->belongsTo(RgClient::class, 'idClient');
        }
        public function estado()
        {
            return $this->belongsTo(RgState::class, 'idState');
        }
        public function employee()
        {
            return $this->belongsTo(RgEmployee::class, 'idEmployee');
        }
    
}
