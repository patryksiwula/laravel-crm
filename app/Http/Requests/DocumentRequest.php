<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
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
            'file_name' => ['required', 'string'],
			'description' => ['required', 'string'],
			'file' => ['required', 'file', 'mimes:doc,docx,pdf'],
			'user_id' => ['required', 'numeric', 'min:1']
        ];
    }
}
