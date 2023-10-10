<?php

namespace Database\Seeders;

use App\Models\Station;
use App\Models\Trip;
use App\Models\TripLines;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Trip::factory(30)->create()->each(function ($trip){


            $i = 1;
            $stations = Station::whereNotIn("id",[$trip->start_station_id , $trip->end_station_id])->get();
            $stations = $stations->random(rand(2,15));
            TripLines::create([
                "trip_id" => $trip->id,
                "station_id" => $trip->start_station_id,
                "order" => $i,
                "start" => 1,
                "end" => 0
            ]);
            foreach ($stations as $index => $station){

                $i++;
                TripLines::create([
                    "trip_id" => $trip->id,
                    "station_id" => $station->id,
                    "order" => $i,
                    "start" => 0,
                    "end" => 0
                ]);
            }

            TripLines::create([
                "trip_id" => $trip->id,
                "station_id" => $trip->end_station_id,
                "order" => $i + 1,
                "start" => 0,
                "end" => 1
            ]);
        });
    }
}
