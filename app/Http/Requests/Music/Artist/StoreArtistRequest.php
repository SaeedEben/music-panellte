<?php

namespace App\Http\Requests\Music\Artist;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtistRequest extends FormRequest
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
        $rules =  [

            'name'  ,
            'biography' => 'required',
        ];

        foreach (['en' , 'fa'] as $locale){
            $rules["name.{$locale}"] = 'required|min:3';
        }

        return $rules;
    }
}
