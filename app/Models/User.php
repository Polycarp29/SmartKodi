<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\SystemConfigurations\Authorizations\Roles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'parent_id',
        'is_active',
        'uuid',
        'otp',
        'google_id',
        'google_token',
        'google_refresh_token',
        'registered_from',
        'device_name',
        'facebook_id',
        'facebook_access_token',
        'facebook_refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'otp_expires_at' => 'datetime',
            'last_otp_sent_at' => 'datetime',
            'last_seen_at' => 'datetime',
            'locked_unti' => 'datetime',
        ];
    }


    /**
     * User model relationships
     */

    public function roles()
    {
        return $this->belongsToMany(Roles::class, 'user_roles', 'user_id', 'roles_id');
    }



    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id')->with('parent');
    }

    /**
     * The children will include any user associated by the parent or created by the parent
     */

    public function children()
    {
        return $this->hasMany(User::class, 'parent_id')->with('children');
    }
}
