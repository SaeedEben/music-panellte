<?php

namespace App\Http\Resources\Music\Song;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Music\Song;

/**
 * Class SongShowResource
 *
 * @package App\Http\Resources\Music\Song
 *
 *
 * @mixin Song
 */
class SongShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @param Song
     *
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
