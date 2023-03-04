<?php

namespace Modules\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryFormRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if ($this->method() === 'POST') {
            return [
                'category_id' => "required",
                'name' => "required|unique:sub_categories,name",
                'ad_type_id' => "required",
            ];
        } else {
            return [
                'category_id' => "required",
                'name' => "required|unique:sub_categories,name,{$this->subcategory->id}",
            ];
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'category_id.required' => "The category field is required.",
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
