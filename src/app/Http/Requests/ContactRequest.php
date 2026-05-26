<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'last_name' => ['required', 'string', 'max:8'],
            'first_name' => ['required', 'string', 'max:8'],
            'gender' => ['required', 'in:1,2,3'],
            'email' => ['required', 'email'],
            'tel1' => ['required', 'numeric', 'digits_between:1,5'],
            'tel2' => ['required', 'numeric', 'digits_between:1,5'],
            'tel3' => ['required', 'numeric', 'digits_between:1,5'],
            'address' => ['required', 'string', 'max:255'],
            'building' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'detail' => ['required', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'last_name.required' => '姓を入力してください',
            'last_name.string' => '姓を文字列で入力してください',
            'last_name.max' => '姓は8文字以内で入力してください',

            'first_name.required' => '名を入力してください',
            'first_name.string' => '名を文字列で入力してください',
            'first_name.max' => '名は8文字以内で入力してください',

            'gender.required' => '性別を選択してください',
            'gender.in' => '性別を選択してください',

            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',

            'tel1.required' => '電話番号を入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel1.numeric' => '電話番号は半角数字で入力してください',
            'tel2.numeric' => '電話番号は半角数字で入力してください',
            'tel3.numeric' => '電話番号は半角数字で入力してください',
            'tel1.digits_between' => '電話番号は5桁以内の数字で入力してください',
            'tel2.digits_between' => '電話番号は5桁以内の数字で入力してください',
            'tel3.digits_between' => '電話番号は5桁以内の数字で入力してください',

            'address.required' => '住所を入力してください',
            'address.string' => '住所を文字列で入力してください',
            'address.max' => '住所は255文字以内で入力してください',

            'building.string' => '建物名を文字列で入力してください',
            'building.max' => '建物名は255文字以内で入力してください',

            'category_id.required' => 'お問い合わせの種類を選択してください',
            'category_id.exists' => 'お問い合わせの種類を選択してください',

            'detail.required' => 'お問い合わせ内容を入力してください',
            'detail.string' => 'お問い合わせ内容を文字列で入力してください',
            'detail.max' => 'お問い合わせ内容は120字以内で入力してください',
        ];
    }
}
