<?php

namespace App\Repository;

use App\Models\Item;
use App\Models\Location;

class LocationRepository
{

    public function findAll()
    {
        return Location::all();
    }

    public function save(array $data)
    {
        $location = new Location();
        $location->create($data);
    }

    public function delete(Location $location)
    {
        $location->delete();
    }

    public function forceDelete(Location $location)
    {
        $location->forceDelete();
    }

    public function update(array $data, Location $location)
    {
        $location->update($data);
    }
}
