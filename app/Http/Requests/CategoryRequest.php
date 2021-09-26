<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'image' => 'required',
            'status' => 'required',
            'slug' => 'string'
        ];

        foreach(config('translatable.locales') as $locale){
            $rules[$locale.'.title'] = 'string';
            $rules[$locale.'.summary'] = 'string';
            $rules[$locale.'.description'] = 'string';
            }
            return $rules;
    }
}
