<?php

namespace App\Http\Requests\Music\Genre;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGenreRequest extends FormRequest
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
        $rules = ['name'];

        foreach (['en' , 'fa'] as $locale){
            $rules["name{$locale}"] = 'required|min:2';
        }

        return $rules;
    }
}
