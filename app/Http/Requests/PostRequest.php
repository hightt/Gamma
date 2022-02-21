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
            'title' => 'required|max:64',
            'content' => 'required',
            'user_id' => Auth::check() ? '' : 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Nie jesteś zalogowany.',
            'content.required' => 'Treść posta jest pusta.',
            'title.required' => 'Brak tytułu.',
            'title.max' => 'Tytuł posta jest zbyt długi (max: 64 znaków).',
        ];
    }
}
