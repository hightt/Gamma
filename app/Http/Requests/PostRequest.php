<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PostRequest extends FormRequest
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
            'post_title' => 'required|max:64',
            'post_content' => 'required|max:1024',
            'user_id' => Auth::check() ? '' : 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Nie jesteś zalogowany.',
            'post_content.required' => 'Treść posta jest pusta.',
            'post_content.max' => 'Zawartość jest zbyt długa (max: 1024 znaków).',
            'post_title.required' => 'Brak tytułu.',
            'post_title.max' => 'Tytuł posta jest zbyt długi (max: 64 znaków).',
        ];
    }
}
