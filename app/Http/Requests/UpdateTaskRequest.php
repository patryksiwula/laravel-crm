<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
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
			'user_id' => ['nullable', 'numeric', 'min:1'],
			'model_id' => ['required', 'numeric', 'min:1'],
			'status' => ['required', 'in:pending,in progress,done']
        ];
    }
}
