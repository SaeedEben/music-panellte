<?php

namespace App\Http\Requests\Music\Genre;

use App\Models\Music\Genre;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreGenreRequest
 *
 * @package App\Http\Requests\Music\Genre
 *
 * @mixin Genre
 */
class StoreGenreRequest extends FormRequest
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
