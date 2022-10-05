<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Color;
use App\Models\Product;
use App\Services\CategoryService;
use App\Services\CollectionService;
use App\Services\ProductService;

class ProductController extends Controller
{
    public function index(CategoryService $categoryService, CollectionService $collectionService)
    {
        $main_category = $categoryService->getMainCategory();
        $current_categories = $categoryService->getCategories();
        $current_collection = $collectionService->getCurrentCollection();

        $tags = ProductService::getTags($current_collection, $main_category);

        return view("front.products", compact("main_category",
            "current_categories",
            "current_collection",
            "tags"
        ));
    }

    public function show(CollectionService $collectionService)
    {
        $slug = request('productSlug');
        $product = Product::where("slug", $slug)
            ->with(["discount", "gallery", "sizes", "collections" => function($q){
                $q->with("discount");
            }])
            ->firstOrFail()
            ->makeHidden([
                'id',
                'user_id',
                'origin_id',
                'discount_id',
                'type_id',
                'status',
                'created_at',
                'updated_at',
                'deleted_at',
            ]);

        $product->additions = $product
            ->additions()
            ->with(['discount', 'type' => function ($q) {
                $q->select(["id", "name", "description"]);
            }])
            ->get()
            ->map(function ($item) {
                $item->makeHidden([
                    'id',
                    'user_id',
                    'origin_id',
                    'discount_id',
                    'type_id',
                    'status',
                    'created_at',
                    'updated_at',
                    'deleted_at',
                ]);
                $item->type->makeHidden(["id"]);
                return $item;
            })
            ->groupBy("type_id");

        if($product->collections) {
            $product->collections->map(function($collection) use($product){
                if($collection && $collection->discount){
                    unset($product->discount);
                    $product->discount = $collection->discount;
                }
            });
        }

        $product_slider = $collectionService->getCollectionBySlider(Collection::SLIDER[4]);

        return view('front.product-order', compact("product", "product_slider"));
    }

    public function filter(ProductService $productService)
    {
        return $productService->frontFilter();
    }

    public function colors()
    {
        return Color::all();
    }
}
