<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.categories.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(["id", "name"])->cursor();
        $pageTitle = "Create";
        return view('admin.categories.add-edit', compact('categories', 'pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, CategoryService $service)
    {
        $service->createOrUpdate($request);
        return redirect()->route('categories.index')->with("message", "Successfully done!");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        $categories = Category::select(["id", "name"])->where('id', '!=', $category->id)->cursor();
        $children = $category->children()->orderBy('rank')->get();

        $pageTitle = "Update";
        return view('admin.categories.add-edit', compact('pageTitle', 'category', 'categories', 'children'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->deleteOrFail();

        return response()->json(["message" => "deleted"], 200);
    }

    public function filter(Request $request)
    {
        return CategoryService::filter($request);
    }

    public function sort_children(Request $request, CategoryService $service)
    {
        if ($service->sort_children($request))
            return response()->json(["message" => "sorted"]);

        return response()->json(["message" => "not sorted"], 400);
    }

    public function category_products(Category $category)
    {
        $products = $category->products()->paginate(20);
        return view("admin.categories.products", compact('category', 'products'));
    }

    public function add_product(Category $category, Product $product)
    {
        $category->products()->attach($product->id);
        return response()->json([]);
    }

    public function remove_product_from_category(Category $category, Product $product)
    {
        $category->products()->detach($product->id);
        return redirect()->back()->with("message", "Product successfully removed from category!");
    }
}
