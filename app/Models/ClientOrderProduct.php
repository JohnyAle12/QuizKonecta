<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientOrderProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_order_id',
        'product_id',
        'quantity',
        'total',
        'subtotal'
    ];
}
