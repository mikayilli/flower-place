<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if(!request()->is(["flwrplc/*", "flwrplc"])){
            session()->flash("login", "any");
            return route("front-home");
        }
        if (! $request->expectsJson()) {
            return route('adminLogin');
        }
    }
}
