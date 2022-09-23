<?php

namespace App\Http\Controllers;

use App\Exports\PricesExport;
use App\Http\Requests\StorePriceRequest;
use App\Models\Item;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Excel;

class PriceController extends Controller
{
    public function store(StorePriceRequest $request)
    {

        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Price::create($data);
        dd($data);
        return Redirect::back();
    }

    public function destroy(Price $price)
    {
        $price->destroy($price);
        return Redirect::back();
    }

    public function download(Item $item)
    {
        $filename = "Detalles del item $item->name.xlsx";
        $export = new PricesExport($item->id);
        return Excel::download($export, $filename);
    }
}
