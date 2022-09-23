<?php

namespace App\Services;

use App\Models\Item;
use App\Repository\ItemRepository;
use App\Repository\PriceRepository;

class ItemServices
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
        if ($this->priceRepository->associatedPriceByitem($item))
            return $this->itemRepository->delete($item);
        else
            return $this->itemRepository->forceDelete($item);
    }

    public function updateItem(array $data)
    {
        return $this->itemRepository->update($data);
    }
}
