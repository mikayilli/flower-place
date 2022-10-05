<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS_PAYMENT_FAILED = 1;
    const STATUS_ORDER_RECEIVED = 2;
    const STATUS_CONFIRMED = 3; //Confirmed, in progress
    const STATUS_READY = 4; //Ready, waiting for courier
    const STATUS_ON_WAY = 5; //Delivered to the courier, on the way
    const STATUS_DELIVERED = 6; //Order delivered
    const STATUS_CANCELED = 7;

    protected $fillable = [
        "customer_id",
        "store_id",
        "address_id",
        "total",
        "sub_total",
        "discount_amount",
        "payment_type",
        "delivery_type",
        "delivery_status",
        "status"
    ];

    protected $casts = [
      "status" => 'boolean'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function detail()
    {
        return $this->belongsTo(Detail::class);
    }

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(OrderStatusHistory::class);
    }
}
