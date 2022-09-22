<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Price;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MonitorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $query = '%' . $search . '%';
            $items = Item::where('name', 'like', $query)->orderBy('name')->paginate(5);
        } else {
            $items = Item::orderBy('name')->paginate(5);
        }

        $prices = [];

        $endDate = Carbon::now();

        $startDate = Carbon::now()->subDays(7);

        $item_id = $request->input('item_id');
        if($item_id) {
            $prices = Price::where('item_id',  $item_id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
        } else{
            $prices = [];
        }

        return view('monitor.index')
        ->with('search', $search)
        ->with('items', $items)
        ->with('prices', $prices)
        ->with('endDate', $endDate)
        ->with('startDate', $startDate);
    }
}
