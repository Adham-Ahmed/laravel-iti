<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $title = $this->request->get('title');
        return [
            'title' => ['required','min:3',Rule::unique('posts')->ignore($title, 'title')],
            'imageName' => 'nullable|image|mimes:jpg,png',
            'description' => 'required|string|min:10',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
