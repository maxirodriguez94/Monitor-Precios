<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Services\ItemServices;
use App\Models\Item;
use App\Models\Price;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class ItemController extends Controller
{

    public function __construct(ItemServices $itemService)
    {
        $this->itemServices = $itemService;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $items = $this->itemServices->showItem($search);
        return view('items.index')
            ->with('items', $items)
            ->with('search', $search);
    }

    public function store(StoreItemRequest $request)
    {
        $item = $request->all();
        $this->itemServices->storeItem($item);

        return Redirect::back();
    }

    public function destroy(Item $item)
    {
        $this->itemServices->destroyItem($item);
        return Redirect::back();
    }

    public function edit(Item $item)
    {
        return view('items.edit')->with('item', $item);
    }

    public function update(Request $request, Item $item)
    {
        $this->itemServices->updateItem($item);
        return redirect('/items');
    }
}
