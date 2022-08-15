<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePersonRequest extends FormRequest
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
            'name' => ['required'],
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('people')->ignore($this->organization->id)],
			'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
			'address' => ['required']
        ];
    }
}
