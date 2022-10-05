<?php

namespace App\Services\Payment;

use App\Interfaces\PayableInterface;
use App\Models\Order;

class TinkoffPayment implements PayableInterface
{
    private $api;
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->api = new TinkoffMerchantAPI();
    }

    public function pay()
    {
        $params = [
            'OrderId' => $this->order->id,
            'Amount'  => $this->order->total * 100
        ];

        $this->api->init($params);

        if($this->api->error){
            return ["success" => false, "error" => $this->api->__get('error')];
        }
        else {
            return [
                "success" => true,
                "data" => [
                    "paymentUrl" => $this->api->__get('paymentUrl')
                ]
            ];
        }
    }

    public function setAmount($amount)
    {
        $this->amount = $amount * 100;
        return $this;
    }

    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }
}
