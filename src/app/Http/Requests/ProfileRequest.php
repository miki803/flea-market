<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
        return [
            "profile_image" => ['nullable', 'image', 'mimes:jpeg,png', 'max:4096'],
            "name" => ['required', 'max:20'],
            "postal_code" => ['required'],
            "address" => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'profile_image.image' => '画像ファイルを選択してください',
            'profile_image.mimes' => '画像はJPEGまたはPNG形式でアップロードしてください',
            'name.required' => 'お名前を入力してください',
            "name.max" => 'お名前は20文字以内で入力してください',
            'postal_code.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',
        ];
    }
}
