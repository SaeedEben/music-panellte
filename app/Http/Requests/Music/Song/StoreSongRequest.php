<?php

namespace App\Http\Requests\Music\Song;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSongRequest extends FormRequest
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
        $rules = [
            'name' ,
            'duration' => 'required|format:i:s',
        ];

        foreach (['en' , 'fa'] as $locale){
            $rules["name.{$locale}"] = 'required|min:3';
        }

        return $rules;
    }
}
