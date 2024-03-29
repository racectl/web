<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function communities(): BelongsToMany
    {
        return $this->belongsToMany(Community::class, 'community_members');
    }

    public function shortName()
    {
        return Str::of($this->last_name)->limit(3, '')->upper();
    }

    public function accPlayerId()
    {
        return 'S' . $this->steam_id;
    }

    public function getDisplayNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
