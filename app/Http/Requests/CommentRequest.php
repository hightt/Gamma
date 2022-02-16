<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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

    public function rules()
    {
        if (auth()->check()) {
            return [
                'content' => 'required|max:255',
            ];
        }

        return [
            'content' => 'required|max:255',
            'user_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Nie jesteś zalogowany.',
            'content.required' => 'Komentarz jest pusty.',
            'content.max' => 'Komentarz nie może być dłuższy niz 255 znaków.',
        ];
    }
}
