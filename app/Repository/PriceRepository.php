<?php

namespace App\Repository;

use App\Models\Location;
use App\Models\Price;

class PriceRepository
{
    public function associatedPriceByItem(Object $item)
    {
        return Price::where('item_id', $item->id)->exists();
    }

    public function associatedPriceByLocation(Location $location)
    {
        return Price::where('location_id', $location->id)->exists();
    }
}
