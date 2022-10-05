<?php

namespace App\Services;

use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryService
{
    public static function add($files)
    {
        foreach ($files as $key => $file) {
            if(!file_exists(storage_path() . '/app/public/products/gallery')) {
                Storage::makeDirectory('public/products/gallery');
            }

            $image = $file;
            $data['image'] = $filename = md5(uniqid(rand(), true)) . ".webp";
            $image_resize = Image::make($image->getRealPath());
            $image_resize->encode('webp', 100)
                ->save(storage_path() . '/app/public/products/gallery/' . $filename);

            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(420, 445);
            $image_resize->encode('webp', 100)
                ->save(storage_path() . '/app/public/products/gallery/thumb_' . $filename);

            Gallery::where('product_id', request('id'))
                ->where('rank', '>=', $key + 1)
                ->increment("rank");

            Gallery::create([
                "user_id" => auth()->id(),
                "product_id" => request('id'),
                "photo" => $filename,
                "rank" => $key
            ]);
        }
    }
}
