<?php

namespace App\Http\Resources\Music\Artist;

use App\Models\Music\Artist;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ArtistShowResource
 *
 * @package App\Http\Resources\Music\Artist
 *
 * @mixin Artist
 */
class ArtistShowResource extends JsonResource
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
            'name_fa'    => $this->getTranslation('name', 'fa'),
            'name_en'    => $this->getTranslation('name', 'en'),
            'biography'  => $this->biography,
            'created_at' => $this->created_at->format('Y-m-d H:i'),
        ];
    }
}
