<?php

namespace App\Models\Music;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

/**
 * Class Category
 *
 * @package App\Models\Music
 *
 * @property int    $id
 * @property object $name
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property Song[] $song
 *
 */
class Category extends Model
{
    protected $fillable = ['name'];

    // ------------------- translator ------------------------
    use HasTranslations , softDeletes;

    public $translatable = ['name'];

     // ------------------- Relations ------------------------


    public function songs()
    {
        return $this->hasMany(Song::class);
    }

}
