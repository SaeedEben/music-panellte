<?php

namespace App\Repository\Music;


abstract class AbstractArtistRepository
{
    public function getcachekey($id)
    {
        return "show_{$id}";
    }
}
