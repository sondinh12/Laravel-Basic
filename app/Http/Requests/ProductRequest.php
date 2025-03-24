<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|max:255|string',
            'price'=>'required|integer|min:1',
            'quantity'=>'required|integer|min:1',
            'image' => 'file|mimes:jpg,png|max:2048',
            'category_id'=>'required',
            'status'=>'required'
        ];
    }

    public function messages(){
        return [
            'name.required'=>'Tên sản phẩm không được bỏ trống',
            'name.max'=>'Tên chỉ giới hạn 255 kí tự',
            'name.string'=>'Tên phải là chuỗi kí tự',
            'price.required'=>'Giá không được bỏ trống',
            'price.integer'=>'Giá phải là 1 số nguyên',
            'price.min'=>'Giá phải là 1 số nguyên > 0',
            'quantity.required'=>'Số lượng không được bỏ trống',
            'quantity.integer'=>'Số lượng phải là số nguyên',
            'quantity.min'=>'Số lượng phải là số nguyên > 0',
            'image.mimes'=>'Ảnh phải có định dạng JPG,PNG',
            'image.file'=>'Tệp tải lên phải là 1 file hợp lệ',
            'image.max'=>'Dung lượng không vượt quá 2MB',
            'category_id.required'=>'Danh mục không được bỏ trống',
            'status.required'=>'Trạng thái không được bỏ trống',
        ];
    }
}
