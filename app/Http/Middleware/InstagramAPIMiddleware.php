<?php

namespace App\Http\Middleware;

// use App\Facades\Instagram;
use Closure;
use Illuminate\Support\Facades\Auth;
use InstagramScraper\Instagram;
use Phpfastcache\Helper\Psr16Adapter;

class InstagramAPIMiddleware
{
    public function handle($request, Closure $next)
    {
        // if(Auth::user()->instagram){
        //     Instagram::setAccessToken(Auth::user()->instagram->access_token);
        // }

         
        $username = 'fatemedev1';
        $password = 'Dev@1254';

        $instagram  = Instagram::withCredentials(
            new \GuzzleHttp\Client(),
            $username,
            $password,
            new Psr16Adapter('Files')
        );

        $instagram->login();
        $instagram->saveSession();

        print('hello');
        return $next($request);
    }
}