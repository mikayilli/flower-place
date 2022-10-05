<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;

class Promo extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        if (!request()->is(["flwrplc/*", "flwrplc"]))
            static::addGlobalScope(new ActiveScope);
    }

    protected $fillable = [
        "user_id",
        "code",
        "end_date",
        "start_date",
        "percent",
        "quantity",
        "current_quantity",
        "status",
        "type",
        "min_amount",
        "max_amount",
        "fix_amount",
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
