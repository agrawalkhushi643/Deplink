<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfSignUpDisabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!config('auth.sign_up.enabled', false)) {
            return response()->redirectTo('/')
                ->with('status', __("Registration disabled, please contact with the administrator if you'd like to create an account."));
        }

        return $next($request);
    }
}
