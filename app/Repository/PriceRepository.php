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

    public function save($data)
    {
        $data = $data->all();
        $data['user_id'] = auth()->user()->id;

        $price = new Price();
        return $price->create($data);
    }

    public function destroy(Price $price)
    {
        $price->delete();
    }
}
