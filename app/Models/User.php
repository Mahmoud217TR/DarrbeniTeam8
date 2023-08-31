<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // , HasUuids
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'phone',
        'uuid',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    // public function collage()
    // {
    //     return $this->belongsTo(Collage::class);
    // }
    public function codes()
    {
        return $this->hasOne(Code::class);
    }
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    public function complaints()
    {
        return $this->hasOne(Complaints::class);
    }
    
    
    public function hasRole($role)
    {
        return $this->roles()->whereIn('role_name', $role)->exists();
    }
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
}
