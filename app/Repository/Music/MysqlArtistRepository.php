<?php

namespace App\Repository\Music;

use App\Models\Music\Artist;


class MysqlArtistRepository extends AbstractArtistRepository implements ArtistRepositoryInterface
{

    public function getartist(int $id)
    {

        $cachekey = $this->getcachekey($id);

        if (cache()->has($cachekey)){
            return cache()->get($cachekey);
        }

        $artist = Artist::findOrFail($id);

        cache()->put($cachekey , $artist);

        return $artist;
    }


}
