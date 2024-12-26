<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rate extends Model
{
    //

    
    protected $fillable = [
        'card_id',
        'quantity',
        'inner_quantity',
        'total',
        'inner_price_total',
        'extra_inner_price',
        'discount_amount',
        'grand_total'
    ];
}
