<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RgWaitinClient extends Model
{
    use HasFactory;
    protected $table = 'rgwaitingclient';
    protected $fillable = ['idRoom', 'startDate', 'endDate', 'idClient'];

    public function room()
        {
            return $this->belongsTo(RgRoom::class, 'idRoom');
        }
        public function client()
        {
            return $this->belongsTo(RgClient::class, 'idClient');
        }

}
