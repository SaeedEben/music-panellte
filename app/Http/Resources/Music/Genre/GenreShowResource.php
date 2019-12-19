<?php

namespace App\Http\Resources\Music\Genre;

use App\Models\Music\Genre;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * Class GenreShowResource
 *
 * @package App\Http\Resources\Music\Genre
 *
 * @mixin Genre
 */
class GenreShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name_fa' => $this->getTranslation('name' , 'fa'),
            'name_en' => $this->getTranslation('name' , 'en'),
        ];
    }
}
