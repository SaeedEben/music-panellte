<?php

namespace App\Models\Feature;

use App\Models\Music\Song;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Favorite
 *
 * @package App\Models\Feature
 *
 * @property int  $id
 *
 * @property User $user_id
 * @property Song $song_id
 *
 */
class Favorite extends Model
{
    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
