<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Location;
use App\Models\Price;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $locations = Location::all();
        $items  = Item::all();
        $prices = Price::all();

        return view('home')
            ->with('locations', $locations)
            ->with('items', $items)
            ->with('prices', $prices);
    }
}
