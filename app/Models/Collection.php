<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collection extends Model
{
    use HasFactory, SoftDeletes;

    const BANNERS = [
        "under main slider",
        "middle section",
        "main slider"
    ];

    const SLIDER = [
        "under main banner",
        "under middle section banner",
        "new bouquets",
        "insta feed",
        "product page"
    ];

    protected $fillable = [
        'name',
        'user_id',
        'product_id',
        'discount_id',
        'banner_name',
        'name',
        'slug',
        'description',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'status',
        'slider',
        'image',
        'rank'
    ];

    protected static function boot()
    {
        parent::boot();

        if (!request()->is(["flwrplc/*", 'flwrplc']))
            static::addGlobalScope(new ActiveScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function discount() {
        return $this->belongsTo(Discount::class);
    }

}
