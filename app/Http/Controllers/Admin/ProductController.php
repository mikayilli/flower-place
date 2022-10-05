<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Color;
use App\Models\Discount;
use App\Models\Gallery;
use App\Models\Label;
use App\Models\Origin;
use App\Models\Product;
use App\Models\Size;
use App\Models\Type;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.products.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::cursor();
        return view('admin.products.add-edit', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductService $service)
    {
        $product = $service->createOrUpdate($request);

        if(isset($product->errors))
            return redirect()->back()->withErrors($product->errors);

        return redirect()->route('products.edit', $product)->with("message", "Successfully done!");


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $product->load('labels', 'colors');
        $gallery = $product->gallery()->orderBy("rank")->get();
        $sizes = $product->sizes;
        $origins = Origin::cursor();
        $discounts = Discount::cursor();
        $labels = Label::cursor();
        $colors = Color::cursor();
        $types = Type::cursor();


        return view('admin.products.add-edit', compact(
            'product',
            'gallery',
            'sizes',
            'origins',
            'discounts',
            'labels',
            'colors',
            'types'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return ProductService::filter($request);
    }

    public function remove_photo(Request $request)
    {
        $gallery = Gallery::find($request->id);

        if($gallery->rank >= 1)
            Gallery::where("product_id", $gallery->product_id)
                ->where("rank", ">=", $gallery->rank)
                ->decrement("rank");

        $gallery->deleteOrFail();
    }

    public function change_rank(Request $request)
    {
        $gallery = Gallery::findOrFail($request->id);
        if($gallery->rank < $request->rank) {
            Gallery::where("product_id", $gallery->product_id)
                ->whereBetween("rank", [$gallery->rank, $request->rank])
                ->decrement("rank");
        }
        else {
            Gallery::where("product_id", $gallery->product_id)
                ->whereBetween("rank", [$request->rank, $gallery->rank])
                ->increment("rank");
        }

        $gallery->update(["rank" => $request->rank]);

    }

    public function add_size(Product $product)
    {
            Size::updateOrCreate(["product_id" => $product->id],[
                "user_id" => auth()->id(),
                "product_id" => $product->id,
                "name_small" => request('name_small'),
                "name_medium" => request('name_medium'),
                "name_big" => request('name_big'),
                "price_small" => request('price_small'),
                "price_medium" => request('price_medium'),
                "price_big" => request('price_big'),
            ]);

        return redirect()->back()->with("message", "done");
    }

    public function product_addition(Product $product)
    {
        $additions = $product->additions()->with('type')->paginate(20);
        return view("admin.products.additions", compact('product', 'additions'));
    }


    public function add_product(Product $product, Product $addition)
    {
         $additions = $product->additions()
            ->distinct("type_id")
            ->get()
            ->pluck('type_id');

        if($additions->count() >= 3 && !$additions->contains($addition->type_id)) {
            return response()->json(["addition" => "This product already has three different types of products!"], 422);
        }

        $product->additions()->attach($addition->id);
        return response()->json([]);
    }

    public function remove_product_from_additions(Product $parent_product, Product $child_product)
    {
        $parent_product->additions()->detach($child_product->id);
        return redirect()->back()->with("message", "Product successfully removed from collection!");
    }
}
