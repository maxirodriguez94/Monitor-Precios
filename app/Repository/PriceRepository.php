<?php

namespace App\Repository;

use App\Models\Price;

class PriceRepository
{
    public function associatedPriceByitem(Object $item)
    {
        return Price::where('item_id', $item->id)->exists();
    }
}
