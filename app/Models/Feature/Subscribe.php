<?php

namespace App\Models\Feature;

use App\Models\Music\Artist;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Subscribe
 *
 * @package App\Models\Feature
 * @property int $id
 *
 * @property User $user_id
 * @property Artist $artist_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class Subscribe extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }
}
