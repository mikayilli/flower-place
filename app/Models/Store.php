<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory, SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        if (!request()->is(["flwrplc/*", 'flwrplc']))
            static::addGlobalScope(new ActiveScope);
    }

    protected $fillable = [
        "user_id",
        "manager_id",
        "name",
        "slug",
        "address",
        "phone",
        "email",
        "status"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

}
