<?php

namespace App\Http\Controllers;

use App\Exports\PricesExport;
use App\Http\Requests\StorePriceRequest;
use App\Models\Item;
use App\Models\Price;
use App\Service\PriceService;
use Illuminate\Support\Facades\Redirect;

class PriceController extends Controller
{
    public function __construct(PriceService $priceService)
    {
        $this->priceService = $priceService;
    }
    public function store(StorePriceRequest $request)
    {
        $this->priceService->storePrice($request);
        return Redirect::back();
    }

    public function destroy(Price $price)
    {
        $this->priceService->destroyPrice($price);
        return Redirect::back();
    }

    public function downloadItem(Item $item)
    {
        return $this->priceService->downloadItem($item);
    }
}
