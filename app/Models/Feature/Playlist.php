<?php

namespace App\Models\Feature;

use App\Models\Music\Song;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Playlist
 *
 * @package App\Models\Feature
 *
 * @property int    $id
 *
 * @property string $name
 * @property User   $user_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Playlist extends Model
{
    protected $fillable = ['name'];

    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function songs()
    {
        return $this->belongsToMany(Song::class);
    }
}
