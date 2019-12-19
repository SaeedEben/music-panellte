<?php

namespace App\Models\Music;

use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 *
 * @package App\Models\Music
 *
 * @property int $id
 *
 * @property string $body
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property User $user_id
 */
class Comment extends Model
{
    protected $fillable = ['body'];

    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>

    public function commentable()
    {
        return $this->morphTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
