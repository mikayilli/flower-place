<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke()
    {
        $user = auth('customer')
                        ->user()
            ->only(["full_name", "phone"]);
        return view('front.card', compact('user'));
    }
}
