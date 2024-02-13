<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'ad_id' => ['required', 'string', 'max:255'],
            'impressions' => ['required', 'numeric', 'min:0'],
            'unique_clicks' => ['nullable', 'numeric', 'min:0'],
            'clicks' => ['nullable', 'numeric', 'min:0'],
            'leads' => ['nullable', 'numeric', 'min:0'],
            'conversion' => ['nullable', 'numeric', 'min:0'],
            'roi' => ['nullable', 'numeric'],
        ];
    }
}
