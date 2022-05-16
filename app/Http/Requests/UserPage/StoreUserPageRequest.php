<?php

namespace App\Http\Requests\UserPage;
use App\Rules\IranPhoneNumberRule;


use Illuminate\Foundation\Http\FormRequest;

class StoreUserPageRequest extends FormRequest
{
    public function validated()
    {
        return array_merge(parent::validated());
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
            'main_page' => ['required', 'string', 'max:255'],
            'second_page' => ['nullable', 'string', 'max:255'],
            'third_page' =>  ['nullable', 'string', 'max:255'],
            'phone' => ['required', new IranPhoneNumberRule],
            'admin_id'=> ['nullable'],
            'super_admin_id'=> ['nullable'],
            'expired_at' => ['nullable']
        ];
    }
}
