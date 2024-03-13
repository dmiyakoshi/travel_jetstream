<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
        $route = $this->route()->getName();

        $rule = [
            'title' => 'required|string|max:50',
            'hotel_id' => 'required|exists:hotels,id',
            'due_date' => 'required|date|after:yesterday',
            'price' => 'required|integer|min:0|max4294967000',
            'description' => 'required|string|max:2000',
            // 本来は meal をtableにするべき PlanConst::MEAL_LISTの値を使用している
            'meal'=> 'required|integer|min:0|max3:',
            'status' => 'required|boolean',
        ];

        if($route === 'plan.update') {
            $rule['due_date'] = 'required|date|after:yesterday';
        }

        return $rule;
    }
}
