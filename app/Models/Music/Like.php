<?php

namespace App\Models\Music;

use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Like
 *
 * @package App\Models\Music
 *
 * @property int $id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Like extends Model
{
    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likable()
    {
        return $this->morphTo();
    }
}
