<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('location.index')->with('locations', $locations);
    }

    public function store(StoreLocationRequest $request)
    {
        Location::create($request->all());
        return Redirect::back();
    }

    public function destroy(Location $location)
    {
        if (Price::where('location_id', $location->id)->exists())
            $location->delete();
        else
            $location->forceDelete();
        return Redirect::back();
    }

    public function edit(Location $location)
    {
        return view('location.edit')->with('location', $location);
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $location->update($request->only('name'));
        return redirect('/locations');
    }
}
