<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CollerctionRequest;
use App\Http\Controllers\Controller;
use App\Services\CollectionService;
use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.collections.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = "Create";
        $discounts = Discount::cursor();
        $banners = Collection::select(["banner_name"])->distinct()->get()->pluck('banner_name');
        return view('admin.collections.add-edit', compact('pageTitle', "banners", 'discounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CollerctionRequest $request, CollectionService $service)
    {
        $collection = $service->createOrUpdate($request);

        if (isset($collection->errors))
            return redirect()->back()->withErrors($collection->errors);

        return redirect()->route('collections.index')->with("message", "Successfully done!");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        $pageTitle = "Update";
        $collection->load('product');
        $banners = Collection::select(["banner_name"])->distinct()->get()->pluck('banner_name');
        $discounts = Discount::cursor();
        return view('admin.collections.add-edit', compact('pageTitle', 'banners', 'collection', 'discounts'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Collection $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collection $collection)
    {
        $collection->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return CollectionService::filter($request);
    }

    public function collection_products(Collection $collection)
    {
        $products = $collection->products()->paginate(20);
        return view("admin.collections.products", compact('collection', 'products'));
    }

    public function add_product(Collection $collection, Product $product)
    {
        if ($collection->discount_id && $product->discount_id) {
            return response()->json(["collection" => "There is a discount on the product and the collection at the same time. Remove one of the discounts to continue.!"], 422);
        }

        $collection->products()->attach($product->id);
        return response()->json([]);
    }

    public function remove_product_from_collection(Collection $collection, Product $product)
    {
        $collection->products()->detach($product->id);
        return redirect()->back()->with("message", "Product successfully removed from collection!");
    }

    public function sort()
    {
        foreach (request('data') as $id => $rank) {
            Collection::where("id", $id)->update(["rank" =>  $rank]);
        }
    }
}
