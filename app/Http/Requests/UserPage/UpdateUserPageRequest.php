<?php

namespace App\Http\Requests\UserPage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPageRequest extends FormRequest
{
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
            'expired_at' => ['nullable']
        ];
    }
}
