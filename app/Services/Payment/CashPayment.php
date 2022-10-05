<?php

namespace App\Services\Payment;

use App\Interfaces\PayableInterface;

class CashPayment implements PayableInterface
{

    public function pay()
    {
        return [
            "success" => true,
            "data" => []
        ];
    }
}
