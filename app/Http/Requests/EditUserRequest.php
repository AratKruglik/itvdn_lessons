<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'lastname' => 'string|nullable',
            'phone' => 'string|nullable',
            'address' => 'string|nullable',
            'is_admin' => 'boolean|nullable',
            'is_manager' => 'boolean|nullable',
        ];
    }
}
