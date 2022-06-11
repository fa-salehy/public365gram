<?php

namespace App\Http\Requests\AdminTag;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminTagRequest extends FormRequest
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
            'name' => ['required','regex:/^[a-zA-Z0-9.-_]+$/'],
            'super_admin_id'=> ['nullable'],
        ];
    }
}
