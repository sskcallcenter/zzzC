<?php

namespace App\Http\Requests\Ajax\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ItemRequest extends FormRequest
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
            'textbox' => 'required|max:16',
            'textarea' => 'required|max:100',
            'radiobtn' => 'required',
            'select' => 'required',
            'checkbox' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'textbox.required' => ':attributeは必須項目です。',
            'textbox.max' => ':attributeは16文字以内です。',
            'textarea.required' => ':attributeは必須項目です。',
            'textarea.max' => ':attributeは100文字以内です。',
            'radiobtn.required' => ':attributeは必須項目です。',
            'select.required' => ':attributeは必須項目です。',
            'checkbox.required' => ':attributeは１つ必ず選択してください。',
        ];
    }

    public function attributes()
    {
        return [
            'textbox' => 'テキストボックス',
            'textarea' => 'テキストエリア',
            'radiobtn' => 'ラジオボタン',
            'select' => 'セレクトボックス',
            'checkbox' => 'チェックボックス',
        ];
    }

    /**
     * [override] バリデーション失敗時ハンドリング
     *
     * @param Validator $validator
     * @throw HttpResponseException
     * @see FormRequest::failedValidation()
     */
    protected function failedValidation(Validator $validator)
    {
        $response['status']  = 400;
        $response['statusText'] = 'Failed validation.';
        $response['errors']  = $validator->errors();
        throw new HttpResponseException(
            response()->json($response, 200)
        );
    }
}
