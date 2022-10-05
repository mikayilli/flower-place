<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "customer_id",
        "order_id",
        "product_id",
        "parent_id",
        "type_id",
        "comment",
        "size_id",
        "product_price",
        "price",
        "count",
        "total",
        "sub_total",
        "discount_amount",
    ];
}
