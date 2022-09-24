<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Price;
use App\Service\ItemService;
use App\Service\PriceService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonitorController extends Controller
{
    public function __construct(ItemService $itemService, PriceService $priceService)
    {
        $this->itemService = $itemService;
        $this->priceService = $priceService;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');

        $items = $this->itemService->showItem($search);

        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(7);

        $item_id = $request->input('item_id');

        $prices = $this->priceService->showPrices($item_id, $startDate, $endDate);

        return view('monitor.index')
            ->with('search', $search)
            ->with('items', $items)
            ->with('prices', $prices)
            ->with('endDate', $endDate)
            ->with('startDate', $startDate)
            ->with('item_id', $item_id);
    }
}
