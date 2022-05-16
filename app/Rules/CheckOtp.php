<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class CheckOtp implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $phone = request()->get('phone');

        $n1 = request()->get('n1');
        $n2 = request()->get('n2');
        $n3 = request()->get('n3');
        $n4 = request()->get('n4');
        $n5 = request()->get('n5');
        

        $value = $n1.$n2.$n3.$n4.$n5.$value;
        
        $user = Auth::user();

        if ($user->otp == $value) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'کد اشتراک وارد شده صحیح نیست';
    }
}
