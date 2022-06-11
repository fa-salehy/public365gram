<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Laravel\Socialite\Facades\Socialite;


class InstagramController extends Controller
{
    // public function getUser($username)
    // {
    //     // dd($username);
    //     // $response = Http::get('https://api.instagram.com/oauth/authorize?client_id=661743151877897
    //     // &redirect_uri=https://admin.365gram.ir/
    //     // &scope=user_profile,user_media
    //     // &response_type=code');


    //     // $client = new Client();
    //     // $res = $client->request('GET', 'https://api.instagram.com/oauth/authorize?client_id=661743151877897
    //     // &redirect_uri=https://admin.365gram.ir/
    //     // &scope=user_profile,user_media
    //     // &response_type=code');
    //     // $url = $res->getBody()->getContents();

    //     $insta = Socialite::driver('instagram')->user();
    //     $details = [
    //         "access_token" => $insta->token
    //     ];
    //     return redirect($url);
    // }

    public function redirectToInstagramProvider()
    {
        return Socialite::with('instagram')->scopes([
            "user_profile","user_media"])->redirect();
    }

    public function handleProviderInstagramCallback()
    {
        $insta = Socialite::driver('instagram')->user();
        $details = [
            "access_token" => $insta->token
        ];

        if(Auth::user()->instagram){
            Auth::user()->instagram()->update($details);
        }else{
            Auth::user()->instagram()->create($details);
        }
        return redirect('/');
    }
    // public function handleProviderInstagramCallback($code){
    //     dd($code);
    // }
}
