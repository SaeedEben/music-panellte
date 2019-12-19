<?php

namespace App\Models\Music;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class File
 *
 * @package App\Models\Music
 *
 * @property int $id
 *
 * @property string $image_path
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 */

class File extends Model
{
    protected $fillable = ['image_path'];

    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>

    public function fileable()
    {
        return $this->morphTo();
    }
}
