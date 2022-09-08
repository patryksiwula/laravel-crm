<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string'],
			'description' => ['nullable', 'string'],
			'source' => ['required', 'string', 'in:facebook,instagram,linkedin,other'],
			'lead_value' => ['required', 'numeric'],
			'search.*.model_id' => ['nullable', 'integer'],
			'search.*.model_type' => ['nullable', 'string'],
			'products.*.product_id' => ['nullable', 'integer'],
			'products.*.quantity' => ['nullable', 'integer']
        ];
    }
}
