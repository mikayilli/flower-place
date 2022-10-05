<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'user_id',
        'discount_id',
        'parent_id',
        'slug',
        'description',
        'meta_tag_title',
        'meta_tag_description',
        'meta_tag_keywords',
        'status',
        'image',
        'rank'
    ];

    protected static function boot()
    {
        parent::boot();

        if (!request()->is(["flwrplc/*", "flwrplc"]))
            static::addGlobalScope(new ActiveScope);
    }

    public function parent()
    {
        return $this->hasOne(Category::class, 'id', 'parent_id')
            ->withDefault(["name" => "----"]);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
