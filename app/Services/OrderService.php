<?php

namespace App\Services;

use App\Http\Requests\OrderStoreRequest;
use App\Models\Detail;
use App\Models\Order;
use App\Models\Product;
use App\Models\Store;

class OrderService
{
    public function createOrder(OrderStoreRequest $request)
    {
        \DB::beginTransaction();

            $total = 0;
            $sub_total = 0;

            $order = $this->setOrder($request);

            foreach ($request->cards as $card){
                $item = [];

                $product = Product::whereSlug($card['slug'])
                    ->with(["discount", "sizes", "collections" => function($q){
                        $q->with("discount");
                    }])
                    ->firstOrFail();

                //set product discount if its collection has
                if($product->collections) {
                    $product->collections->map(function($collection) use($product){
                        if($collection && $collection->discount){
                            unset($product->discount);
                            $product->discount = $collection->discount;
                        }
                    });
                }

                //$price will not change with discount, $item['price'] will change
                $price = $item['price'] = $product->price;

                //set size price
                if($product->sizes && isset($card["selected_size"]) && !empty($card["selected_size"])) {
                    $name = $card["selected_size"]["name"];
                    if($product->sizes->{"price_".$name}) {
                        $price = $item['price'] = $product->sizes->{"price_".$name};
                        $item['size_id'] = $product->sizes->id;
                    }
                }

                //set discount
                if($product?->discount?->percent) {
                    $item['price'] = $item['price'] - ($item['price'] * $product->discount->percent) / 100;
                }

                $item = array_merge($item,[
                    "customer_id" => $request->user('customer')->id,
                    "product_id" => $product->id,
                    "product_price" => $product->price,
                    "total" => $item['price'] * $card['count'],
                    "sub_total" => $price * $card['count'],
                    "count" => $card['count'],
                    "discount_amount" => (($price - $item['price']) * $card['count'])
                ]);

                $total += $item['total'];
                $sub_total += $item['sub_total'];
                $order_item = $order->items()->create($item);

                //check card has additions
                if(isset($card['items']) && !empty($card['items'])){
                    foreach ($card['items'] as $card_item) {
                        $product = Product::whereSlug($card_item['slug'])->with("discount")->firstOrFail();

                        $item['price'] = $product->price;

                        //set discount
                        if($product?->discount?->percent) {
                            $item['price'] -= ($item['price'] * $product->discount->percent) / 100;
                        }

                        //set addition discount
                        if($product->addition_discount) {
                            $item['price'] -= ($item['price'] * $product->addition_discount) / 100;
                        }

                        $item = array_merge($item,[
                            "customer_id" => $request->user('customer')->id,
                            "type_id" => $product->type_id,
                            "parent_id" => $order_item->id,
                            "product_id" => $product->id,
                            "product_price" => $product->price,
                            "total" => $item['price'] * $card_item['count'],
                            "sub_total" => $product->price * $card_item['count'],
                            "count" => $card_item['count'],
                            "discount_amount" => (($product->price -  $item['price']) * $card_item['count'])
                        ]);

                        $total += $item['total'];
                        $sub_total += $item['sub_total'];

                        $order->items()->create($item);
                    }
                }
            }

            $order->update([
                "total" => $total,
                "sub_total" => $sub_total,
                "discount_amount" => $sub_total - $total
            ]);

        \DB::commit();

        return $order;
    }


    private function setOrder($request) {

        $address = (object)["id" => null];
        $details = (object)["id" => null];
        $store_id = null;

        if($request->delivery["method"] == 'delivery') {
            $address = $this->setAddress();
            $details = $this->setDetails();
        }

        if($request->delivery["method"] == 'pickup') {
            $store_id = Store::whereSlug($request->delivery["pickup"])->firstOrFail()->id;
        }

        //payment cash -> status = received
        $status = Order::STATUS_ORDER_RECEIVED;

        //payment cart -> status = payment failed
        if($request->payment['type'] === 'cart')
            $status = Order::STATUS_PAYMENT_FAILED;



        return  Order::create([
            "customer_id" => $request->user('customer')->id,
            "store_id" => $store_id,
            "send_date" => $request->delivery['send_date'],
            "address_id" => $address?->id,
            "detail_id" => $details?->id,
            "total" => 0,
            "status" => $status,
            "sub_total" => 0,
            "payment_type" => $request->payment['type']
        ]);
    }

    private function setAddress() {
        $data = array_merge([
            "customer_id" => request()->user('customer')->id,
        ], request("delivery.address"));

        return  AddressService::create($data);
    }

    private function setDetails() {
        $data = [
            "customer_id" => request()->user('customer')->id,
            "sender_name" => request('delivery.sender.full_name'),
            "sender_phone" => request('delivery.sender.phone'),
            "sender_email" => request('delivery.sender.email'),
            "sender_provide_name" => request('delivery.sender.provide_name'),
            "recipient_name" => request('delivery.recipient.full_name'),
            "recipient_phone" => request('delivery.recipient.phone'),
            "anonymous" => request('delivery.recipient.anonymous'),
        ];

        return  Detail::create($data);
    }
}
