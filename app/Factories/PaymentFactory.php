<?php

namespace App\Factories;

use App\Services\Payment\CashPayment;
use App\Services\Payment\TinkoffPayment;

class PaymentFactory
{
    /**
     * @throws \Exception
     */
    public function initializePayment($order, $type)
    {
        if($type == 'cart'){
            return new TinkoffPayment($order);
        }

        if($type == 'cash'){
            return new CashPayment();
        }

        throw new \Exception("Unsupported Payment Method", 422);
    }
}
