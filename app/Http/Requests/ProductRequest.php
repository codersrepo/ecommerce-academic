<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        $locale = config('translatable.locale');
        $rules = [
            'en.title' => 'required',
            'en.summary' => 'required',
            'en.description' => 'required',
            'en.price' => 'required',
            'en.discount_percent' => 'required',
            'en.brand_name' => 'required',
            'product_code' => 'required',
            // 'images' => 'required',
            'image_icon' => 'required',
            // 'video' => '',
            'status' => 'required',
            'slug' => 'string',
            'size' => 'required','string',
            'colour' => 'required','string',
            'category_id' => 'required','exists:categories,id',
       ];

        foreach(config('translatable.locales') as $locale){
            $rules[$locale.'.title'] = 'string';
            $rules[$locale.'.summary'] = 'string';
            $rules[$locale.'.description'] = 'string';
            $rules[$locale.'.price'] = 'string';
            $rules[$locale.'.product_color'] = 'string';
            $rules[$locale.'.brand_name'] = 'string';
            $rules[$locale.'.discount_percent'] = 'string';
            }
            return $rules;
    }
}
