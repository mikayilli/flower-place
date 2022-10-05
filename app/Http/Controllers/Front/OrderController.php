<?php

namespace App\Http\Controllers\Front;

use App\Factories\PaymentFactory;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderStoreRequest;
use App\Models\Order;
use App\Services\OrderService;
use App\Services\OrderStatusHistoryService;

class OrderController extends Controller
{
    /**
     * @throws \Exception
     */
    public function order(OrderStoreRequest $request, OrderService $orderService, PaymentFactory $paymentFactory): \Illuminate\Http\JsonResponse
    {
        //create order
        $order = $orderService->createOrder($request);

        //add order status
        OrderStatusHistoryService::create($order);

        //create order payment
        $payment = $paymentFactory->initializePayment($order, $request->payment['type']);
        $data = $payment->pay();

        return response()->json($data, $data['success'] ? '200' : 422);
    }

    public function my_order_status($uuid)
    {
        abort_if(!$uuid, 404);

        $status = [
            1 => 'Платеж не прошел',
            2 => "Заказ получен",
            3 => 'Подтвержден, в процессе',
            4 => 'Готов, ожидает курьера',
            5 => 'Передан курьеру, в пути',
            6 => 'Заказ доставлен',
            7 => 'Отменено',
        ];
        $order = Order::where('customer_id', auth('customer')->id())
            ->where("uuid", $uuid)
            ->with("statusHistory")
            ->firstOrFail();

        return view('front.panel.order-status', compact('order', 'status'));
    }

    public function callback()
    {

    }
}
