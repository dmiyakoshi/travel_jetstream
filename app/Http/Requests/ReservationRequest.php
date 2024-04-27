<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ReservationRequest extends FormRequest
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
        // 使わない　コントローラー内でバリデーション
        return [];
        //     // 予約日が今日以降、掲載日までの検証
        //     'reservation_date' => "required|date|after_or_equal:now|befor_or_equal:{$due_date}:"
        // ];
    }
}
