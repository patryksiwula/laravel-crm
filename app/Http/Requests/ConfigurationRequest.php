<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfigurationRequest extends FormRequest
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
			'email' => ['required', 'email'],
			'address' => ['required', 'string'],
            'vat' => ['required', 'numeric'],
			'date_format' => ['required', 'string', 'in:d.m.Y,d-m-Y,d/m/Y,Y.m.d,Y-m-d,Y/m/d']
        ];
    }
}
