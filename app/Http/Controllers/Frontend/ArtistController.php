<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repository\Music\MysqlArtistRepository;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function show($id)
    {
        return resolve('App\Repository\Music\MysqlArtistRepository')
            ->getartist($id);
    }
}
