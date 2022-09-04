<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProjectRequest extends FormRequest
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
			'description' => ['string', 'nullable'],
			'deadline' => ['required', 'date'],
			'user_id' => ['nullable', 'numeric', 'min:1'],
			'model_id' => ['required', 'numeric', 'min:1'],
			'model_type' => ['required', 'string', 'in:App\Models\Client\Organization,App\Models\Client\Person'],
			'status' => ['required', 'string', 'in:pending,in progress,done']
        ];
    }
}
