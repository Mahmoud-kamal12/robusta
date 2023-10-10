<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripLines extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id','station_id','order','start','end'];

    public function trip(){
        return $this->belongsTo(Trip::class,"trip_id");
    }


    public function station(){
        return $this->belongsTo(Station::class,"station_id");
    }

}
