<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\OtpRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\Customer;
use App\Scopes\ActiveScope;
use App\Services\Sms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $customer = Customer::create($request->validated() + ["status" => 0, "otp" => random_int(100000, 999999)]);
        session()->put('otp_phone', $customer->phone);

        (new Sms)->sendOne($customer->phone, "your otp code: {$customer->otp}");
        return redirect()->back()->with("otp", 1);
    }

    public function otp(OtpRequest $request)
    {
        if(session()->has('otp_phone')) {
            $customer = Customer::withoutGlobalScope(ActiveScope::class)
                            ->where("phone", session('otp_phone'))
                            ->first();

            if(!$customer) {
                return redirect()->back()->withErrors(["code" => "customer does not  exist"], 'otp');
            }

            if($customer->otp != $request->code) {
                return redirect()->back()->withErrors(["code" => "otp code is not right"], 'otp');
            }
            $customer->update(["status" => 1]);
            return redirect()->back()->withErrors(["any" => 1], "login");
        }

        return redirect()->back()->withErrors(["x" => "Already Registered"], "login");
    }

    public function login(LoginRequest $request)
    {
        $customer = Customer::withoutGlobalScope(ActiveScope::class)
                    ->where("phone", $request->phone)
                    ->first();

        if(!$customer || !password_verify($request->password, $customer->password)) {
            return redirect()->back()->withErrors(["x" => "invalid credentials"], "login");
        }

        if(!$customer->status) {
            session("otp_phone", $customer->phone);
            return redirect()->back()->withErrors(["code" => "otp code needed"], "otp");
        }

        Auth::guard('customer')->login($customer, $request->remember_me);

        return redirect()->back();
    }

    public function reset_password(Request $request)
    {
        $request->validate(['phone' => 'required']);
        $customer = Customer::where('phone', $request->phone)->first();

        if(!$customer) {
            return redirect()
                ->back()
                ->withErrors(["reset_customer" => 'try again'])
                ->with("open_reset_modal", 1);
        }
        session()->put('reset_otp_phone', $customer->phone);
        $customer->update(["otp" => random_int(100000, 999999)]);
        (new Sms)->sendOne($customer->phone, "your otp code: {$customer->otp}");
        return redirect()->back()->with("reset_otp", 1);
    }

    public function reset_otp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'reset_otp' => 'required',
            'phone' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator,'reset')
                ->with("reset_otp", 1);
        }

        $customer = Customer::where('phone', $request->phone)
            ->where('otp', $request->reset_otp)
            ->first();

        if(!$customer) {
            return redirect()
                ->back()
                ->withErrors(["reset_otp" => 'try again'], 'reset')
                ->with("reset_otp", 1);
        }

        session()->put('reset_otp_phone', $customer->phone);

        return redirect()->back()->with("open_reset", 1);
    }

    public function reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
        ]);

        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator,'reset_last_modal')
                ->with("open_reset", 1);
        }

        $phone = session('reset_otp_phone');

        if(!$phone) {
            return redirect()
                ->back()
                ->withErrors(["reset_customer" => 'your session has been expired'])
                ->with("open_reset_modal", 1);
        }

        $customer = Customer::where('phone', $phone)->first();

        if(!$customer) {
            return redirect()
                ->back()
                ->withErrors(["password" => "something went wrong"],'reset_last_modal')
                ->with("open_reset", 1);
        }

        $customer->update(['password' => $request->password]);

        return redirect()->back()->withErrors(["any" => 1], "login");
    }

    public function logout() {
        Auth::guard('customer')->logout();
        return redirect()->route('front-home');
    }
}
