<?php

namespace App\Http\Controllers;

use App\Models\TripLines;
use App\Http\Requests\StoreTripLinesRequest;
use App\Http\Requests\UpdateTripLinesRequest;

class TripLinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTripLinesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTripLinesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TripLines  $tripLines
     * @return \Illuminate\Http\Response
     */
    public function show(TripLines $tripLines)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TripLines  $tripLines
     * @return \Illuminate\Http\Response
     */
    public function edit(TripLines $tripLines)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTripLinesRequest  $request
     * @param  \App\Models\TripLines  $tripLines
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTripLinesRequest $request, TripLines $tripLines)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TripLines  $tripLines
     * @return \Illuminate\Http\Response
     */
    public function destroy(TripLines $tripLines)
    {
        //
    }
}
