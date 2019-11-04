<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBoard extends FormRequest
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
            'name' => ['required', 'unique:boards', 'min:5', 'max:255'],
            'display_name' => ['nullable', 'sometimes', 'min:1', 'max:255'],
            'explain' => ['max:1024'],
        ];
    }
}
