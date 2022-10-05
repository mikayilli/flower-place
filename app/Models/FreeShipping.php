<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FreeShipping extends Model
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
        "end_date",
        "start_date",
        "min_amount",
        "limit",
        "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
