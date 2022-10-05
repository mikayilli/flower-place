<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "call_full_name",
        'count',
        'date_at',
        "call_phone",
        "wp",
        "status",
    ];

    protected static function boot()
    {
        parent::boot();

        if (!request()->is(["flwrplc/*", "flwrplc"])) {
            static::addGlobalScope(new ActiveScope);
        }

    }
}
