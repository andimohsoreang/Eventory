<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
        ];
    }

    /**
     * Get the role associated with the user.
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Check if user has specific role
     */
    public function hasRole($roleName)
    {
        return $this->role->role === $roleName;
    }

    /**
     * Check if user has specific roles
     */
    public function hasAnyRole($roles)
    {
        return in_array($this->role->role, $roles);
    }

    /**
     * Check if user has permission through role
     */
    public function hasPermission($permission)
    {
        return $this->role->hasPermission($permission);
    }

    /**
     * Get user's sessions
     */
    public function sessions()
    {
        return $this->hasMany(Session::class);
    }
}
