<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PriceController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = auth()->user()->id;
        Price::create($data);

        return Redirect::back();
    }

    public function destroy(Price $price)
    {
        $price->destroy($price);
        return Redirect::back();
    }
}
