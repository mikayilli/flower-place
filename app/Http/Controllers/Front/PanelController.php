<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Address;

class PanelController extends Controller
{
    public function address()
    {
       return view("front.panel.address");
    }

    public function settings()
    {
        $user = auth()->guard('customer')->user();
        return view("front.panel.settings", compact('user'));
    }

    public function orders()
    {
        return view("front.panel.orders");
    }

    public function update()
    {
        request()->validate([
            "email" => "unique:customers,email,".auth()->guard('customer')->id(),
            "phone" => "unique:customers,phone,".auth()->guard('customer')->id(),
            "password" => "nullable|confirmed"
        ]);


        //Todo check Otp if phone changed
        auth()->guard('customer')->user()->update(array_filter(request()->all()));

        return redirect()->back()->with("message", "updated");
    }

    public function get_address()
    {
        return Address::where('customer_id', auth()->guard('customer')->id())->paginate(20);
    }
}
