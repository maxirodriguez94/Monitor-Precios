<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::paginate(5);
        
        return view('items.index')->with('items', $items);
    }

    public function store(Request $request)
    {
        Item::create($request->all());
        return Redirect::back();
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return Redirect::back();
    }
}
