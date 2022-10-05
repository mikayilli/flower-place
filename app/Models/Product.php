<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $hidden = ['pivot'];

    protected $fillable = [
        'user_id',
        'origin_id',
        'discount_id',
        'type_id',
        'name',
        'slug',
        'image',
        'price',
        'consist_quantity',
        'height',
        'width',
        'tags',
        'description',
        'short_description',
        'addition_discount',
        'specification',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'status',
        'rank',
    ];

    protected static function boot()
    {
        parent::boot();

        if (!request()->is("flwrplc/*"))
            static::addGlobalScope(new ActiveScope);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function collections() {
        return $this->belongsToMany(Collection::class);
    }

    public function sizes() {
        return $this->hasOne(Size::class);
    }

    public function origin()
    {
        return $this->belongsTo(Origin::class);
    }

    public function labels() {
        return $this->belongsToMany(Label::class);
    }

    public function colors() {
        return $this->belongsToMany(Color::class);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function discount() {
        return $this->belongsTo(Discount::class);
    }

    public function additions() {
        return $this->belongsToMany(Product::class, 'addition_product', 'product_id', 'addition_id');
    }

    public function scopeMySelect($query, $data = [])
    {
        if(empty($data)) {
            return $query->select([
                'discount_id',
                'name',
                'slug',
                'image',
                'price',
                'consist_quantity',
                'height',
                'width',
                'description',
                'specification',
                'short_description',
                'rank',
                'addition_discount'
            ]);
        }

        return $query->addSelect($data);
    }
}
