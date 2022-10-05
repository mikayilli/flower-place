<?php

use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\FreeShippingController;
use App\Http\Controllers\Admin\CallRequestController;
use App\Http\Controllers\Front\StoreFrontController;
use App\Http\Controllers\Admin\CollectionController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Front\RegisterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OriginController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Front\PanelController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\LabelController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\SaleController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//Backend routes...
Route::group(["prefix" => 'flwrplc'], function() {
    //login
    Route::view('login', 'admin.login')
        ->name('adminLogin')
        ->middleware("guest");

    Route::post('login', [LoginController::class,"login"])
        ->name('adminLogin')
        ->middleware("guest");

    Route::get('logout', [LoginController::class,"logout"])
        ->name('adminLogout')
        ->middleware("auth:web");

    //Auth middleware routes...
    Route::group(["middleware" => "auth:web"], function() {

        Route::view('/', 'admin.home')->name('adminHome');

        //Users routes...
        Route::post('users/filter', [UserController::class, 'filter']);
        Route::resource('users', UserController::class);

        //category routes...
        Route::post('categories/filter', [CategoryController::class, 'filter']);
        Route::get('categories/{category}/products', [CategoryController::class, 'category_products']);
        Route::post('categories/{category}/product/{product}', [CategoryController::class, 'add_product']);
        Route::delete('categories/{category}/product/{product}', [CategoryController::class, 'remove_product_from_category'])->name('remove_product_from_category');
        Route::post('categories/sort_children', [CategoryController::class, 'sort_children']);
        Route::resource('categories', CategoryController::class);

        //collection routes...
        Route::post('collections/filter', [CollectionController::class, 'filter']);
        Route::get('collections/{collection}/products', [CollectionController::class, 'collection_products'])->name("collection_products");
        Route::post('collections/{collection}/product/{product}', [CollectionController::class, 'add_product']);
        Route::delete('collections/{collection}/product/{product}', [CollectionController::class, 'remove_product_from_collection'])->name('remove_product_from_collection');
        Route::post("collections/sort", [CollectionController::class, 'sort']);
        Route::resource('collections', CollectionController::class);

        //products routes...
        Route::post('/products/filter', [ProductController::class, 'filter']);
        Route::get('products/{product}/additions', [ProductController::class, 'product_addition']);
        Route::post('products/{product}/additions/{addition}', [ProductController::class, 'add_product']);
        Route::delete('products/{product}/additions/{addition}', [ProductController::class, 'remove_product_from_additions'])->name('remove_product_from_additions');
        Route::get('/products/filter-c', [ProductController::class, 'filter']);
        Route::post('products/remove-photo', [ProductController::class, 'remove_photo'])->name('products.remove_photo');
        Route::post('products/change-rank', [ProductController::class, 'change_rank'])->name('products.change_rank');
        Route::post('products/{product}/add-size', [ProductController::class, 'add_size'])->name('products.add_size');
        Route::resource('products', ProductController::class);


        Route::post('origins/filter', [OriginController::class, 'filter']);
        Route::resource('origins', OriginController::class);

        Route::post('stores/filter', [StoreController::class, 'filter']);
        Route::resource('stores', StoreController::class);

        Route::post('discounts/filter', [DiscountController::class, 'filter']);
        Route::resource('discounts', DiscountController::class);


        Route::post('labels/filter', [LabelController::class, 'filter']);
        Route::resource('labels', LabelController::class);

        Route::post('colors/filter', [ColorController::class, 'filter']);
        Route::resource('colors', ColorController::class);

        Route::post('promos/filter', [PromoController::class, 'filter']);
        Route::resource('promos', PromoController::class);

        Route::post('free-shipping/filter', [FreeShippingController::class, 'filter']);
        Route::resource('free-shipping', FreeShippingController::class);

        //roles routes ...
        Route::resource('roles', RoleController::class);


        Route::post('types/filter', [TypeController::class, 'filter']);
        Route::resource('types', TypeController::class);

        //customer routes...
        Route::post('customers/filter', [CustomerController::class, 'filter']);
        Route::get('customers/{customer}/view', [CustomerController::class, 'view'])->name('customers.view');
        Route::get('customers/all', [CustomerController::class, 'all'])->name('customers.all');

        //call requests routes...
        Route::post('call-requests/filter', [CallRequestController::class, 'callRequestFilter']);
        Route::get('call-requests/all', [CallRequestController::class, 'all'])->name('callRequests');

        //orders routes...
        Route::post('orders/filter', [AdminOrderController::class, 'filter']);
        Route::get('orders/{order}/view', [AdminOrderController::class, 'view'])->name('orders.view');
        Route::get('orders/all', [AdminOrderController::class, 'all'])->name('orders.all');

    });
});

Route::get('/', [HomeController::class, "index"])->name('front-home');
Route::post('/call-request', [HomeController::class, "callRequest"])->name('callRequest');
Route::view('/shipping', 'front.shipping')->name('shipping');
Route::view('/how-to-order', 'front.how-to-order')->name('how-to-order');
Route::view('/comments', 'front.comments')->name('comments');
Route::view('/stores', 'front.stores')->name('stores');


Route::view('/favorites', 'front.favorites')->name('favorites');
Route::get('/sales', [SaleController::class, "index"])->name('sales.index');
Route::view('/feedback', 'front.feedback')->name('feedback');
Route::view('/order-page', 'front.order-page')->name('feedback');
Route::view('/popups', 'front.popups')->name('popup');
Route::get('/checkout', CheckoutController::class)
    ->name('card')
    ->middleware("auth:customer");
Route::post('/register', [RegisterController::class, "register"])
    ->name('customer.register')
    ->middleware("guest:customer");

Route::post('/otp', [RegisterController::class, "otp"])->name('customer.otp')
    ->middleware("guest:customer");

Route::post('/login', [RegisterController::class, "login"])
    ->name('customer.login')
    ->middleware("guest:customer");

Route::post('/forgot-password', [RegisterController::class, "reset_password"])
    ->name('customer.reset_password')
    ->middleware("guest:customer");

Route::post('/forgot-otp-check', [RegisterController::class, "reset_otp"])
    ->name('customer.reset_password_otp_check')
    ->middleware("guest:customer");

Route::post('/password-reset', [RegisterController::class, "reset"])
    ->name('customer.password-reset')
    ->middleware("guest:customer");

Route::group(["middleware" => ["auth:customer"]], function(){
    Route::get("logout", [RegisterController::class, "logout"])
        ->name("customer.logout");

    Route::post("/order", [OrderController::class, 'order']);

    Route::group(["prefix" => "panel"],function(){
        Route::get("address", [PanelController::class, "address"])->name("panel.address");
        Route::post("address", [PanelController::class, "get_address"]);
        Route::get("settings", [PanelController::class, "settings"])->name("panel.settings");
        Route::patch("update", [PanelController::class, "update"])->name("panel.update");
        Route::get("orders", [PanelController::class, "orders"])->name("panel.orders");
        Route::get("/order/{uuid}/status",[OrderController::class, 'my_order_status'])->name("my_order_status");
    });
});

Route::post('stores', [StoreFrontController::class, 'index']);

//products pages routes ...
Route::post('/colors/filter', [FrontProductController::class, 'colors'])->name('front-colors');
Route::post('/tags/filter', [FrontProductController::class, 'tags'])->name('front-tags');
Route::post('/products/filter', [FrontProductController::class, 'filter'])->name('front-products.filter');

Route::get("/search", [FrontProductController::class, "index"])->name("menu.search");
Route::get("/category/{parent}/{child?}/{grandchild?}", [FrontProductController::class, "index"])->name("menu.categories");
Route::get("/collection/{collection}", [FrontProductController::class, "index"])->name("menu.collection");
Route::get("/{productSlug}", [FrontProductController::class,"show"])->name("product.without_category");
Route::get("/{cat1}/{productSlug}", [FrontProductController::class,"show"])->name("product.with_1_cat");
Route::get("/{cat1}/{cat2}/{productSlug}", [FrontProductController::class,"show"])->name("product.with_2_cat");
Route::get("/{cat1}/{cat2}/{cat3}/{productSlug}", [FrontProductController::class,"show"])->name("product.with_3_cat");
