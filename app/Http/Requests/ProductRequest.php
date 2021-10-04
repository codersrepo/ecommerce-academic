<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Product;
use App\Models\Language;
use Illuminate\Validation\Rule;


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
        $rules = $this->prepareRulesForMultiTrans();

        return array_merge($rules, [
            'status' => ['required', 'string', Rule::in(Product::STATUS)],
            // 'images' => ['required', 'array', 'min:1', 'max:10'],
            // 'images.*' => ['required'],
            'category' => ['required', 'exists:categories,id'],
            'product_code' => ['required'],
            'image_icon' => ['required'],
            'size' => ['required','string'],
            'colour' => ['required','string'],
            'price' => ['required','integer'],
            'image_id' => ['required']
        ]);
    }

    protected function prepareRulesForMultiTrans()
    {
        $languages = Language::get(['prefix']);


        $rules = $languages->map(function ($lang) {
            $isLangEnglish = $lang->prefix === 'en';
            return [
                'title_' . $lang->prefix => ['required', 'string', 'max:' . ($isLangEnglish ? 200 : 300)],
                'summary_' . $lang->prefix => ['required', 'string', 'max:' . ($isLangEnglish ? 300 : 500)],
                'description_' . $lang->prefix => ['required', 'string', 'max:' . ($isLangEnglish ? 10000 : 20000)],
            ];
        });

        return array_merge(...$rules);
    }
}
