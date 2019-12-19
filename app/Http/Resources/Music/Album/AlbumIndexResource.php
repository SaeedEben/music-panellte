<?php

namespace App\Http\Resources\Music\Album;

use App\Models\Music\Album;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AlbumIndexResource
 *
 * @package App\Http\Resources\Music\Album
 *
 * @mixin Album
 */
class AlbumIndexResource extends JsonResource
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
            'number_of_track' => $this->number_of_track,
            'release_at'      => $this->release_at,

        ];
    }

}
