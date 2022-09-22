<?php

namespace App\Exports;

use App\Invoice;
use App\Models\Price;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;


class PricesExport implements FromCollection, WithHeadings, WithMapping
{
    private $item_id;
    public function __construct($item_id)
    {
        $this->item_id = $item_id;
    }

    public function headings(): array
    {
        return [
            'Ubicacion',
            'Item',
            'Usuario',
            'Valor',
            'Fecha de registro'
        ];
    }
    public function collection()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(7);

        return Price::with('location', 'item', 'user')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('item_id', $this->item_id)->get([
                'location_id',
                'item_id',
                'user_id',
                'value',
                'created_at',
            ]);
    }

    public function map($price): array
    {
        return [
            $price->location->name,
            $price->item->name,
            $price->user->name,
            $price->value,
            $price->created_at
        ];
    }
}
