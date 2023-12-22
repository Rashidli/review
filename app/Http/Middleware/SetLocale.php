<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle($request, Closure $next)
    {

        $header = $request->header('Accept-Language');

        $languages = explode(',', $header);
        $preferredLanguage = $languages[0];

        App::setLocale($preferredLanguage);

        return $next($request);

    }
}
