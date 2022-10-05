<?php


namespace App\Services;


use App\Models\Address;
use Illuminate\Support\Str;
use App\Models\Category;

class AddressService
{
    public static function create($address)
    {
        return Address::create($address);
    }
}
