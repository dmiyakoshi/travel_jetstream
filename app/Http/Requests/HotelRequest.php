<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'adress' => 'required|string|max:50',
            'phonenumber' => 'required|string|max:13',
            'prefecture_id' => 'required|exists:prefectures,id',
            'capacity' => 'required|integer|min:1|max:4000',
            'description' => 'nullable|string|max:200',
        ];
    }
}
