<?php

namespace App\Http\Requests\Admin\Admin;

use App\Rules\IranPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function validated()
    {
        $otp =  rand(100000, 999999);
        return array_merge(parent::validated(),['status'=> 0,'name'=>'مدیر','type_id' => 2,'otp' => $otp]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request. 
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required','email','unique:users'],
            'image' => ['nullable','image','mimes:jpeg,png,jpg,gif,svg','max:4096'],
            'page' => ['required', 'string', 'max:255'],
            'phone' => ['required', new IranPhoneNumberRule, 'unique:users'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'admin_id'=>['nullable']
        ];
    }
}
