<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $collections = Collection::select(["collections.*"])
            ->join("discounts", "collections.discount_id", "=", "discounts.id")
            ->where("discounts.percent", ">", 0)
            ->where("discounts.end_date", ">=", now())
            ->with(["discount","products"])
            ->get()
            ->map(function($item){
                 $item->products->map(function($product) use($item){
                    $product->discount = $item->discount;
                    return $product;
                });

                 return $item;
            });

        return view("front.sales", compact("collections"));
    }
}
