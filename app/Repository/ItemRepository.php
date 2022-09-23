<?php

namespace App\Repository;

use App\Models\Item;

class ItemRepository
{
    public function showItem(?string $search)
    {
        if ($search) {
            $query = '%' . $search . '%';
            return Item::where('name', 'like', $query)->orderBy('name')->paginate(5);
        } else {
            return Item::orderBy('name')->paginate(5);
        }
    }

    public function save(array $data)
    {
        $item = new Item();
        $item->create($data);
    }

    public function delete(Object $item)
    {
        $item->delete();
    }

    public function forceDelete(Object $item)
    {
        $item->forceDelete();
    }

    public function update(array $data, Item $item)
    {
        $item->update($data);
    }
}
