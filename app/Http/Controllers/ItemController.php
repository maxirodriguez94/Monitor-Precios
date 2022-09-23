<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ItemController extends Controller
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

        return view('items.index')
            ->with('items', $items)
            ->with('search', $search);
    }

    public function store(Request $request)
    {
        Item::create($request->all());
        return Redirect::back();
    }

    public function destroy(Item $item)
    {
        if (Price::where('item_id', $item->id)->exists())
            $item->delete();
        else
            $item->forceDelete();
        return Redirect::back();
    }

    public function edit(Item $item)
    {
        dd($item);
        return view('items.edit')->with('item', $item);
    }

    public function update(Request $request, Item $Item)
    {
        dd('a');
        $Item->update($request->only('name'));
        return redirect('/items');
    }
}
