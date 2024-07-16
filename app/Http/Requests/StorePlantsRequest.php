<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePlantsRequest extends FormRequest
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
            'name' => ['required'],
            'species' => ['required'],
            'watering' => ['required', 'integer', 'between:0,5'],
            'date_planted' => ['required', 'date', 'before_or_equal:today'],
            'soil_type' => ['required'],
            'drainage' => ['required'],
            'fertilizer' => ['required'],
            'sunlight' => ['required', 'integer', 'between:0,5'],
            'humidity' => ['required'],
            'notes' => ['required']
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
        ]);
    }
}
