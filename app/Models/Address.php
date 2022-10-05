<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "customer_id",
        "county",
        "address",
        "block",
        "apartment",
       "floor"
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
