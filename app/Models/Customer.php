<?php

namespace App\Models;

use App\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;

class Customer extends Authenticatable implements CanResetPassword
{
    use HasFactory, Notifiable;

    protected $fillable = [
        "full_name",
        "phone",
        "email",
        "password",
        "subscribe",
        "personal_info",
        "status",
        "block",
        "otp"
    ];

    protected static function boot()
    {
        parent::boot();

        if (!request()->is(["flwrplc/*", "flwrplc"])) {
            static::addGlobalScope(new ActiveScope);

            static::addGlobalScope('blocked', function (Builder $builder) {
                $builder->where('block',0);
            });
        }

    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

}
