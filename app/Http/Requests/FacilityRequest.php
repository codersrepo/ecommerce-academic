<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class FacilityRequest extends FormRequest
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
                'status' => ['required', 'string', Rule::in(Category::STATUS)],
                'image' => ['nullable', 'url'],
            ]);
        }
    
        protected function prepareRulesForMultiTrans()
        {
            $languages = Language::get(['prefix']);
    
            $rules = $languages->map(function ($lang) {
                $isLangEnglish = $lang->prefix === 'en';
                return [
                    'title_' . $lang->prefix => ['required', 'string', 'max:' . ($isLangEnglish ? 200 : 300)],
                ];
            });
            return array_merge(...$rules);
        }
    }
