<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //set order observer
        Order::observe(OrderObserver::class);


        if(!request()->is(["flwrplc/*", "flwrplc"])) {
            $categories = Category::whereNull('parent_id')->with('children')->get();
            view()->share("categories", $categories);
        }
    }
}
