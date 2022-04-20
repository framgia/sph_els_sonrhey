<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'full_name',
        'email_address',
        'password',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role() {
        return $this->belongsTo(RoleModel::class, 'role_id', 'role_id');
    }

    public function following() {
        return $this->hasMany(UserRelationshipModel::class, 'following_id', 'user_id');
    }

    public function followed() {
        return $this->hasMany(UserRelationshipModel::class, 'followed_id', 'user_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
}
