<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all();
        return view('location.index')->with('locations', $locations);
    }

    public function store(Request $request)
    {
        Location::create($request->all());
        return Redirect::back();
    }

    public function destroy(Location $location)
    {
        
        $location->delete();
        return Redirect::back();
    }
}
