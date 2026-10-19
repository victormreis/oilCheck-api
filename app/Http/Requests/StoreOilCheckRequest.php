<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOilCheckRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'odometer_at_last_change' => 'required|numeric|lte:current_odometer',
            'current_odometer' => 'required|numeric|gte:odometer_at_last_change',
            'date_at_last_change' => 'required|date|before_or_equal:today',
        ];
    }
}
