<?php

namespace App\Service;

use App\Models\Item;
use App\Repository\ItemRepository;
use App\Repository\PriceRepository;

class ItemService
{
    public function __construct(
        ItemRepository $itemRepository,
        PriceRepository $priceRepository
    ) {
        $this->itemRepository = $itemRepository;
        $this->priceRepository = $priceRepository;
    }

    public function showItem(?string $search)
    {
        return $this->itemRepository->showItem($search);
    }

    public function storeItem(array $data)
    {
        return $this->itemRepository->save($data);
    }

    public function destroyItem(Object $item)
    {
        if ($this->priceRepository->associatedPriceByItem($item))
            return $this->itemRepository->delete($item);
        else
            return $this->itemRepository->forceDelete($item);
    }

    public function updateItem(array $data, Item $item)
    {
        return $this->itemRepository->update($data, $item);
    }
}
