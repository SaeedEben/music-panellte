<?php

namespace App\Models\Feature;

use App\Models\Music\Song;
use App\Models\User\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class History
 *
 * @package App\Models\Feature
 *
 * @property int    $id
 *
 * @property Carbon $start_at
 * @property Carbon $end_at
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */
class History extends Model
{
    protected $fillable = [
        'start_at', 'end_at',
    ];

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
