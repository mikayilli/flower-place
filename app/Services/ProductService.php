<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductService
{
    public static function filter($request)
    {
        return Product::when($request->name, fn($query) => $query->where("name", "LIKE", "%" . $request->name . "%"))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->when($request->filled('type_id'), fn($query) => $query->where("type_id", $request->type_id))
            ->with(['user', 'type'])
            ->orderBy('name')
            ->paginate(20);
    }

    public function frontFilter()
    {
        $limit = match (request('limit')) {
            'live' => 4,
            default => 16
        };

        $category = Category::whereSlug(request('category'))->first();
        $collection = Collection::whereSlug(request('collection'))
            ->with(['discount' => function($q){
                return $q->select(["id","name", "percent"]);
            }])
            ->first();

        $products = Product::mySelect()
            ->when(request()->filled('name'), fn($q) => $q->where("name", "LIKE", "%" . request('name') . "%"))
            ->when(request('price.max'), fn($q) => $q->where("price", "<=", request('price.max')))
            ->when(request()->filled('price.min'), fn($q) => $q->where("price", ">=", request('price.min')))
            ->when(!empty(request('colors')), function($query) {
                $query->join("color_product", "products.id", "=","color_product.product_id" );
                $query->whereIn("color_product.color_id", request("colors"));
            })
            ->when($category, function($query) use($category) {
                $query->join("category_product", "products.id", "=","category_product.product_id" );
                $query->where("category_product.category_id", $category->id);
            })
            ->when($collection, function($query) use($collection) {
                $query->join("collection_product", "products.id", "=","collection_product.product_id" );
                $query->where("collection_product.collection_id", $collection->id);
            })
            ->when(request('quantity'), fn($q) => $q->where("consist_quantity", "<=",  request('quantity')))
            ->when(request('lengths'), fn($q) => $q->whereIn("height",request('lengths')))
            ->when(request()->filled('slugs'), fn($q) => $q->whereIn('products.slug', request('slugs')))
            ->when(!empty(request('tags')), function($q){
                $q->where(function($query){
                    $i = 0;
                    foreach (request('tags') as $tag){
                        if($i > 0)
                            $query->orWhere('tags', 'LIKE', "%". $tag . "%");
                        else
                            $query->where('tags', 'LIKE', "%". $tag . "%");

                        $i++;
                    }
                });

            })
            ->with(['discount' => function($q){
                return $q->select(["id","name", "percent"]);
            }])
            ->with(["sizes"])
            ->distinct()
            ->paginate($limit);

        return tap($products)
                ->map(function ($product) use($collection) {

                    if($collection && $collection->discount){
                        unset($product->discount);
                        $product->discount = $collection->discount;
                    }

                    if($product->discount)
                        $product->discount->makeHidden(["id"]);

                    return $product;
                });
    }

    public function createOrUpdate($request)
    {
        $product = Product::find($request->id);
        $data = [
            "user_id" => auth()->id(),
            "slug" => Str::slug(request('name')) ?: null,
        ];

        if(empty($data['slug']))
            unset($data["slug"]);

        if ($request->gallery) {
            GalleryService::add($request->gallery);
        }

        if($request->label_id) {
            $product->labels()->sync(array_filter($request->label_id));
        }

        if($request->color_id) {
            $product->colors()->sync(array_filter($request->color_id));
        }

        if($request->discount_id) {
            $error = $this->checkCollectionDiscount($request->id);
            if(isset($error['errors'])) {
                return (object) $error;
            }
        }

        if($request->hasFile('photo')) {
            if(!file_exists(storage_path() . '/app/public/products')) {
                Storage::makeDirectory('public/products');
            }

            $image = $request->file('photo');
            $data['image'] = $filename = md5(uniqid(rand(), true)) . ".webp";
            $image_resize = Image::make($image->getRealPath());
            $image_resize->encode('webp', 100)
                ->save(storage_path() . '/app/public/products/' . $filename);

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(420,455);
            $image_resize->encode('webp', 100)
                ->save(storage_path() . '/app/public/products/thumb_' . $filename);
        }

        return Product::updateOrCreate(['id' => $request->id], $request->all() + $data);
    }

    public function checkCollectionDiscount($product_id)
    {
            $collections = Product::find($product_id)->collections()
                        ->whereNotNull("discount_id")
                        ->get();

            if($collections->isNotEmpty()) {
                return ["errors" => [
                    "collection" => $collections->map(function($item) {
                        return "<small>This product belongs to a "
                            . "<strong>$item->name</strong>" ." collection, which has a discount."
                            . " <a href='". route("collection_products", $item) ."' target='_blank'> <br> Remove</a>"
                            . " product from collection products list or "."<a href='". route("collections.edit", $item) ."' target='_blank'>remove</a>"." the discount from " . "<strong>$item->name</strong>" ." collection!</small>";
                    })
                ]];
            }

            return true;
    }

    public static function getTags($collection, $category)
    {
        return Product::select(["id","tags"])
            ->when($collection, function($q) use($collection){
                $q->whereHas('collections', function($query) use($collection){
                    $query->where('slug', $collection);
                });
            })
            ->when($category, function($q) use($category){
                $q->whereHas('categories', function($query) use($category){
                    $query->where('slug', $category);
                });
            })
            ->get()
            ->pluck("tags")
            ->map(function($item){
                return array_filter(explode(",", $item));
            })
            ->flatten()
            ->unique();
    }
}
