<?php

namespace App\Service;

use App\Exports\PricesExport;
use App\Models\Price;
use App\Repository\PriceRepository;
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

    public function downloadItem($item)
    {
        $filename = "Detalles del item $item->name.xlsx";
        $export = new PricesExport($item->id);
        return Excel::download($export, $filename);
    }
}
