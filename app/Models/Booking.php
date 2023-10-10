<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','start_station_id','start_station_order','end_station_id','end_station_order','trip_id','seat_number'];

    protected $appends = ["from" , "to"];
    public function start_station(){
        return $this->belongsTo(Station::class,"start_station_id");
    }


    public function end_station(){
        return $this->belongsTo(Station::class,"end_station_id");
    }

    public function user(){
        return $this->belongsTo(User::class , "user_id");
    }

    public  function trip(){
        return $this->belongsTo(Trip::class, "trip_id");
    }

    public function getFromAttribute(){
        return $this->start_station->name;
    }

    public function getToAttribute(){
        return $this->end_station->name;
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->start_station_order = TripLines::where("trip_id",$model->trip_id)->where("station_id",$model->start_station_id)->first()->order;
            $model->end_station_order = TripLines::where("trip_id",$model->trip_id)->where("station_id",$model->end_station_id)->first()->order;
        });

        static::updating(function ($model) {
            $model->start_station_order = TripLines::where("trip_id",$model->trip_id)->where("station_id",$model->start_station_id)->first()->order;
            $model->end_station_order = TripLines::where("trip_id",$model->trip_id)->where("station_id",$model->end_station_id)->first()->order;
        });
    }
}
