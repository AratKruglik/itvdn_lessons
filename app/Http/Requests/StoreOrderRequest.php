<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
            'customerName' => 'required|string|max:150',
            'customerLastName' => 'string|max:150',
            'customerEmail' => 'required|email',
            'customerPhone' => 'required|string',
            'customerAddress' => 'string',
            'customerComment' => 'string',
            'updateUser' => 'boolean',
        ];
    }
}
