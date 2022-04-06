<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\Models\ViewModels\Response;

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
        if (! $request->expectsJson()) {
            // return route('login');
            $response = new Response();
            $response->status_code = 0;
            $response->message = "error";
            $response->data = 'Unauthorized';
            abort(response()->json($response));
        }
    }
}
