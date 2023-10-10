<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id','start_station_id','end_station_id'];

    public $appends = ["name"];

    public function bus(){
        return $this->belongsTo(Bus::class , 'bus_id');
    }

    public function start_station(){
        return $this->belongsTo(Station::class,"start_station_id");
    }

    public function end_station(){
        return $this->belongsTo(Station::class,"end_station_id");
    }

    public function allLines(){
        return $this->hasMany(TripLines::class);
    }

    public function EndDestnations(){
        return $this->hasMany(TripLines::class)->where('start',"!=", 0);
    }

    public function startPoint(){
        return $this->hasOne(TripLines::class)->where('start', 1);
    }

    public function getNameAttribute(){
        return "from " . $this->start_station->name . " to " . $this->end_station->name;
    }
}
