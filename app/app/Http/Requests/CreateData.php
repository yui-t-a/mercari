<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateData extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    //権限関係の記述(現ログインユーザーがリクエストを実行する権限があるか)
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    //入力フォームへのルールの記述
    public function rules()
    {
        return [
            //ユーザー情報(usersテーブル)
            'name' => 'required|max:10',
            'email' => 'required|email',
            'password' => 'required|min:4|max:10',
            'image_file_name' => 'required',
            'comment' => 'max:300',
            'tel' => 'required|min:10|max:11|numeric',
            'zipcode' => 'required|min:7|max:7|numeric',
            'address' => 'required',
            
        ];
    }
    
}
