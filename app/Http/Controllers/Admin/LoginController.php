<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login()
    {
        request()->validate([
            "email" => "required|email",
            "password" => "required",
        ]);

        if(Auth::attempt(request()->only(["email", "password"]), request('remember_me'))) {
            return redirect()->route('adminHome');
        }

        return redirect()->back()->withErrors(["login" => "Credentials does not match!"]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('adminLogin');
    }
}
