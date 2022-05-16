<?php

namespace App\Http\Requests\Admin\User;

use App\Rules\IranPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    // public function validated($key = null, $default = null)
    // {
    //     return array_merge(parent::validated(), ['name'=>'کاربر','type_id' => 3]);
    // }

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
            'firstName' => ['required', 'string'],
            'lastName' => ['required', 'string'],
            'email' => ['nullable', 'email', 'unique:users'],
            'phone' => ['nullable', new IranPhoneNumberRule, 'unique:users'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:4096'],
            'password' => ['nullable', 'confirmed', 'min:8'],
        ];
    }
}
Z