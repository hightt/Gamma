<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
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
        return [
            'content' => 'required|max:256',
            'user_id' => Auth::check() ? '' : 'required',
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
