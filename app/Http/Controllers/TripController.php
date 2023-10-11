<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Models\Booking;
use App\Models\Trip;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\TripLines;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function allTrips(){
        return Trip::paginate(env("LIMIT",25));
    }

    public function allSeats($trip_id){
        $seats = range(1,12);
        $bookings = Booking::where("trip_id" , $trip_id)->pluck("seat_number")->toArray();
        $availableSeats = array_values(array_diff($seats, $bookings));
        return ["compliantly_available" => $availableSeats , "partly_available" => array_values(array_unique($bookings))];
    }

    public function allReserved($trip_id){
        $seats = range(1,12);
        $bookings = Booking::where("trip_id" , $trip_id)->get();
        return $bookings;
    }

    public function booking(Request $request){

        $isReserved = false;
        $user_id = auth()->user()->id;
        $data = $request->only(["trip_id", "start_station_id", "end_station_id", "seat_number"]);
        $data["user_id"] = $user_id;
        $allBooking = Booking::where("trip_id",$request->trip_id)->where("user_id" , $user_id)->where("seat_number" , $request->seat_number)->get();
        $booking_start_station_order = TripLines::where("trip_id",$request->trip_id)->where("station_id",$request->start_station_id)->first()->order;
        $booking_end_station_order = TripLines::where("trip_id",$request->trip_id)->where("station_id",$request->end_station_id)->first()->order;

        foreach ($allBooking as $item) {
            if (in_array($booking_start_station_order, range($item->start_station_order , $item->end_station_order - 1))){
                $isReserved = true;
                break;
            }
            if (in_array($booking_end_station_order, range($item->start_station_order + 1, $item->end_station_order))){
                $isReserved =true;
                break;
            }
        }

        if ($isReserved) {
            return ["message" => "this trip is reserved "];
        }

        $save = Booking::create($data);

        return ["message" => "booking success" , "booking" => $save];
    }

    public function store(Request $request){
        $i = 1;
        $tripData = $request->only(["bus_id","start_station_id","end_station_id"]);
        $trip  = Trip::create($tripData);
        $lines = $request->road_map;

        TripLines::create([
            "trip_id" => $trip->id,
            "station_id" => $trip->start_station_id,
            "order" => $i,
            "start" => 1,
            "end" => 0
        ]);

        foreach ($lines as $line){
            TripLines::create([
                "trip_id" => $trip->id,
                "station_id" => $line["station_id"],
                "order" => $line["order"],
                "start" => 0,
                "end" => 0
            ]);
            $i++;
        }

        TripLines::create([
            "trip_id" => $trip->id,
            "station_id" => $trip->end_station_id,
            "order" => $i,
            "start" => 0,
            "end" => 0
        ]);

        return response()->json(["message" => "the trip added successfully" , "data" => $trip->load('allLines')]);
    }
}

