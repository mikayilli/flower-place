<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "customer_id",
        "sender_name",
        "sender_phone",
        "sender_email",
        "sender_provide_name",
        "recipient_name",
        "recipient_phone",
        "anonymous",
    ];
}
