<?php

namespace App\Http\Resources\Music\Album;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Music\Album;

/**
 * Class AlbumShowResource
 *
 * @package App\Http\Resources\Music\Album
 *
 * @mixin \App\Models\Music\Album
 */
class AlbumShowResource extends JsonResource
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
            'name_fa'         => $this->getTranslation('name', 'fa'),
            'name_en'         => $this->getTranslation('name', 'en'),
            'release_at'      => $this->release_at,
            'number_of_track' => $this->number_of_track,
        ];
    }
}
