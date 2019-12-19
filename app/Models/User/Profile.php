<?php

namespace App\Models\User;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Profile
 *
 * @package   App\Models\User
 *
 * @property int       $id
 *
 * @property string    $first_name
 * @property string    $last_name
 *
 * @property \DateTime $birthday
 * @property int       $mobile
 *
 * @property Carbon    $created_at
 * @property Carbon    $updated_at
 *
 *
 * @property User $user_id
 */
class Profile extends Model
{
    // <<<<<<<<<<<<<<<<<<< Fillables >>>>>>>>>>>>>>>>>>>>>>>

    protected $fillable = [
        'first_name',
        'last_name',
        'birthday',
        'mobile',
    ];

    // <<<<<<<<<<<<<<<<<<< Attributes >>>>>>>>>>>>>>>>>>>>>>>

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
