<?php

namespace App\Service;

use App\Models\Location;
use App\Repository\ItemRepository;
use App\Repository\LocationRepository;
use App\Repository\PriceRepository;

class LocationService
{
    public function __construct(
        LocationRepository $locationRepository
    ) {
        $this->locationRepository = $locationRepository;
    }
    public function showLocation()
    {
        return $this->locationRepository->findAll();
    }

    public function storeLocation(array $data)
    {
        return $this->locationRepository->save($data);
    }

    public function deleteLocation(Location $location)
    {
        return $this->locationRepository->delete($location);
    }

    public function forceDeleteLocation(Location $location)
    {
        return $this->locationRepository->forceDelete($location);
    }

    public function updateLocation(array $data, Location $location)
    {
        return $this->locationRepository->update($data, $location);
    }
}
