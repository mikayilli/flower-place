<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Discount extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        if (!request()->is("flwrplc/*"))
            static::addGlobalScope(new ActiveScope);
    }

    protected $fillable = [
        "user_id",
        "name",
        "percent",
        "end_date",
        "start_date",
        "status"
    ];

    protected $dates = [
        "start_date",
        "end_date",
        "created_at",
        "updated_at",
        "deleted_at"
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
