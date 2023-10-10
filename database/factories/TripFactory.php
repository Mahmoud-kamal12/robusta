<?php

namespace Database\Factories;

use App\Models\Bus;
use App\Models\Station;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Trip>
 */
class TripFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $start = Station::inRandomOrder()->first();
        $end = Station::where("id","!=",$start->id)->inRandomOrder()->first();
        return [
            "bus_id" => Bus::inRandomOrder()->first(),
            "start_station_id" => $start->id,
            "end_station_id" => $end
        ];
    }
}
