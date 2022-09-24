<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Location;
use App\Models\Price;
use App\Service\ItemService;
use App\Service\LocationService;
use App\Service\PriceService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        LocationService $locationService,
        ItemService $itemService,
        PriceService $priceService,
    )
    {
        $this->locationService = $locationService;
        $this->itemService = $itemService;
        $this->priceService = $priceService;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $locations = $this->locationService->showLocation();
        $items  = $this->itemService->showItem(null);
        $prices = $this->priceService->findByUser();
       
        return view('home')
            ->with('locations', $locations)
            ->with('items', $items)
            ->with('prices', $prices);
    }
}
