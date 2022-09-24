<?php

namespace App\Service;

use App\Exports\PricesExport;
use App\Models\Item;
use App\Models\Price;
use App\Repository\PriceRepository;
use DateTime;
use Excel;

class PriceService
{
    public function __construct(PriceRepository $priceRepository)
    {
        $this->priceRepository = $priceRepository;
    }

    public function storePrice($data)
    {
        return $this->priceRepository->save($data);
    }

    public function destroyPrice(Price $price)
    {
        return $this->priceRepository->destroy($price);
    }

    public function downloadItem(Item $item)
    {
        $filename = "Detalles del item $item->name.xlsx";
        $export = new PricesExport($item->id);
        return Excel::download($export, $filename);
    }

    public function showPrices(?int $item_id, DateTime $startDate, DateTime $endDate)
    {
        if ($item_id) {
            $prices = Price::where('item_id',  $item_id)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->get();
        } else {
            $prices = [];
        }
        return $prices;
    }

    public function findByUser()
    {
        return $this->priceRepository->findByUser();
    }


}
