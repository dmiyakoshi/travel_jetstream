<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        function redirectToAuth($request)
        {
            $user = Str::of($request->path())->before('/');
            if (in_array($user, config('fortify.users'))) {
                return route($user . '.login');
            }

            return route('welcome');
        }
        return $request->expectsJson() ? null : redirectToAuth($request);
    }
}
