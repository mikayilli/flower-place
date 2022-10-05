<?php

namespace App\Services;

use App\Models\OrderStatusHistory;

class OrderStatusHistoryService
{
    public static function create($order)
    {
       return OrderStatusHistory::create(['order_id' => $order->id, 'status' => $order->status]);
    }
}
