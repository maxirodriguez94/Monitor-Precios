<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;

use App\Models\Item;
use App\Service\ItemService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class ItemController extends Controller
{

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
    public function index(Request $request)
    {
        $search = $request->input('search');
        $items = $this->itemService->showItem($search);
        return view('items.index')
            ->with('items', $items)
            ->with('search', $search);
    }

    public function store(StoreItemRequest $request)
    {
        $item = $request->all();
        $this->itemService->storeItem($item);

        return Redirect::back();
    }

    public function destroy(Item $item)
    {
        $this->itemService->destroyItem($item);
        return Redirect::back();
    }

    public function edit(Item $item)
    {
        return view('items.edit')->with('item', $item);
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->all();
        $this->itemService->updateItem($data, $item);
        return redirect('/items');
    }
}
