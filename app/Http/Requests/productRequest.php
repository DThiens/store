<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class productRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required|min:6',
            'product_price'=> 'required|integer',
        ];
    }
    public function messages()
    {
        return [
            'required' => ':attribute bắt buộc nhập',
            'min' => ':attribute không được nhỏ hơn :min',
            'integer' => ':attribute phải là số nguyên',
        ];
    }
    public function attributes()
    {
        return [
            'product_name'=> 'Tên sản phẩm',
            'product_price'=> 'Giá sản phẩm',
        ];
    }
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->count()>0) {
                $validator->errors()->add('mgs', 'Something is wrong with this field!');
            }
        });
    }
    public function prepareForValidation()
    {
        $this->merge([
            'create_at'=>date('Y-m-d H:i:s')
        ]);
    }
    public function failedAuthorization()
    {
        throw new HttpResponseException(abort(403));
    }
}
