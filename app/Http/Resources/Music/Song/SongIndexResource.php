<?php

namespace App\Http\Resources\Music\Song;

use App\Models\Music\Song;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SongIndexResource
 *
 * @package App\Http\Resources\Music\Song
 * @mixin Song
 */
class SongIndexResource extends JsonResource
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
            'name_fa'    => $this->getTranslation('name', 'fa'),
            'name_en'    => $this->getTranslation('name', 'en'),
            'release_at' => $this->release_at,
            'duration'   => $this->duration,
        ];
    }
}
