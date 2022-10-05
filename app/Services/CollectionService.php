<?php


namespace App\Services;


use App\Models\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CollectionService
{
    private $current_collection = "";

    public function __construct()
    {
        if(request('collection')) {
            Collection::where("slug",request('collection'))->firstOrFail();
            $this->current_collection = request('collection');
        }
    }

    public static function filter($request)
    {
        return Collection::when($request->name, fn($query) => $query->where("name", "LIKE", "%" . $request->name . "%"))
            ->when($request->banner_name, fn($query) => $query->where("banner_name", "LIKE", "%" . $request->banner_name . "%"))
            ->when($request->filled('status'), fn($query) => $query->where("status", $request->status))
            ->with(['user'])
            ->orderBy('banner_name')
            ->orderBy('rank')
            ->paginate(20);
    }

    public function createOrUpdate($request)
    {
        $collection = Collection::find($request->id);
        $banner_count = 0;
        if($request->banner_name)
            $banner_count = Collection::where("banner_name", $request->banner_name)->count();

        $slider_count = 0;
        if($collection?->slider && $collection->slider != $request->slider)
            $slider_count = Collection::where("slider", $request->slider)->count();

        if($request->id && $collection->banner_name != $request->banner_name && $banner_count >= 3) {
            return (object) ["errors" => ["banner_name" => ["There are already 3 collections in this banner section!"]]];
        } else {
            if(!$request->id && $banner_count >= 3) {
                  return (object) ["errors" => ["banner_name" => ["There are already 3 collections in this banner section!"]]];
            }
        }

        if($request->id && $collection->slider != $request->slider && $slider_count) {
            return (object) ["errors" => ["slider" => ["This slider already belongs to any collection!"]]];
        } elseif ($slider_count) {
            return (object) ["errors" => ["slider" => ["This slider already belongs to any collection!"]]];
        }

        $data = [
            "user_id" => auth()->id(),
            "slug" => Str::slug(request('name')) ?: null,
        ];

        if ($request->hasFile('photo')) {
            if (!file_exists(storage_path() . '/app/public/collections')) {
                Storage::makeDirectory('/public/collections');
            }

            $image = $request->file('photo');
            $data['image'] = $filename = md5(uniqid(rand(), true)) . ".webp";
            $image_resize = Image::make($image->getRealPath());
            $image_resize->encode('webp', 100)
                ->save(storage_path() . '/app/public/collections/' . $filename);

            $resize = match ($request->banner_name){
                'main slider' => [1300, 300],
                default => [292,316]
            };
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(...$resize);
            $image_resize->encode('webp', 100)
                ->save(storage_path() . '/app/public/collections/thumb_' . $filename);
        }

        if ($request->discount_id) {
            $error = $this->checkProductDiscount($request->id);
            if (isset($error['errors'])) {
                return (object)$error;
            }
        }

        Collection::updateOrCreate(['id' => $request->id], $request->all() + $data);
    }

    public function getCollectionBySlider($sliderName)
    {
        $collection = Collection::where("slider", $sliderName)
            ->with(["products" => function ($q) {
                $q->mySelect()->with('discount');
            }
            ])
            ->with("discount")
            ->first();

        if($collection && $collection->discount){
            $collection->products = $collection->products->map(function($product) use($collection){
                unset($product->discount);
                $product->discount = $collection->discount;
                return $product;
            });
        }

        return $collection;
    }

    public function checkProductDiscount($collection_id)
    {
        if (!$collection_id) {
            return true;
        }
        $products = Collection::find($collection_id)
            ->products()
            ->whereNotNull("discount_id")
            ->get();

        if ($products->isNotEmpty()) {
            return ["errors" => [
                "products" => $products->map(function ($item) {
                    return "<small>Product, "."<strong>$item->name</strong>" . " has a discount, which belongs to this collection.
                    <a href='" . route('products.edit', $item) . "' target='_blank'>Remove</a>  a discount from product or
                    <a href='" . route("collection_products", $item->pivot->collection_id) . "' target='_blank'>Remove</a> a product from collection products list.!</small>";
                })
            ]];
        }

        return true;
    }

    public function getCurrentCollection()
    {
        return $this->current_collection;
    }
}
