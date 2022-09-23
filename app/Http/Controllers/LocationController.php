<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLocationRequest;
use App\Http\Requests\UpdateLocationRequest;
use App\Models\Location;
use App\Models\Price;
use App\Repository\PriceRepository;
use App\Service\LocationService;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
    public function __construct(
        LocationService $locationService,
        PriceRepository $priceRepository
    ) {
        $this->locationService = $locationService;
        $this->priceRepository = $priceRepository;
    }
    public function index()
    {
        $locations= $this->locationService->showLocation();
        return view('location.index')->with('locations', $locations);
    }

    public function store(StoreLocationRequest $request)
    {
        $data = $request->all();
        $this->locationService->storeLocation($data);
        return Redirect::back();
    }

    public function destroy(Location $location)
    {
        if ($this->priceRepository->associatedPriceByLocation($location))
            $this->locationService->deleteLocation($location);
        else
           $this->locationService->forceDeleteLocation($location);
        return Redirect::back();
    }

    public function edit(Location $location)
    {
        return view('location.edit')->with('location', $location);
    }

    public function update(UpdateLocationRequest $request, Location $location)
    {
        $data = $request->all();
        $this->locationService->updateLocation($data, $location);
        return redirect('/locations');
    }
}
