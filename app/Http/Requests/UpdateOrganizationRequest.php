<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
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
			'email' => ['required', 'string', 'email', 'max:255', Rule::unique('organizations')->ignore($this->organization)],
			'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10'],
			'address' => ['required', 'string'],
			'vat' => ['required', 'numeric']
        ];
    }
}
