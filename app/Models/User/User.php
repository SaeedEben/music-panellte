<?php

namespace App\Models\User;

use App\Models\Feature\Favorite;
use App\Models\Feature\History;
use App\Models\Feature\Playlist;
use App\Models\Feature\Subscribe;
use App\Models\Music\Comment;
use App\Models\Music\Like;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @package   App\Models\User
 *
 * @property int          $id
 *
 * @property string       $email
 * @property-write string $password
 *
 *
 * @property Carbon       $created_at
 * @property Carbon       $updated_at
 *
 * @property Profile      $profile
 *
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // <<<<<<<<<<<<<<<<<<< Attributes >>>>>>>>>>>>>>>>>>>>>>>

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    // <<<<<<<<<<<<<<<<<<< Relations >>>>>>>>>>>>>>>>>>>>>>>

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

}

