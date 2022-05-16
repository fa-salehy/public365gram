<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckOtp;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
class VerifyController extends Controller
{
    public function index()
    {
        return view('verifyAdmin');
    }

    // public function store($id){
    //     dd($id);
    //     $user = Auth::user();
    //     $user->update(['status' => 1]);

    //     return redirect()->route('home');
    // }
    public function store(Request $request)
    {
        //rules Validation
        $rules = [
            'n6' => ['required', new CheckOtp()],
        ];

        //Error Messages Validation
        $messages = [
            'n6.required' => 'لطفا کد را وارد کنید',
        ];

        //Call Validation
        $validator = Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $user = User::where('id', '=', $request->id)->update(['status' => 1]);
        //$user->update(['isVerified' => 1]);

        return redirect()->route('home');

    }
}
