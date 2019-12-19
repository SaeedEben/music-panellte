<?php

namespace App\Http\Resources\Music\Category;

use App\Models\Music\Category;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CategoryIndexResource
 *
 * @package App\Http\Resources\Music\Category
 * @mixin Category
 */
class CategoryIndexResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
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
