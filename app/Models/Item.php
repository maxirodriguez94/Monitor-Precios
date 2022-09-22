<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function lowestValue($startDate, $endDate)
    {
        return Price::where('item_id', $this->id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->min('value');
    }
}
