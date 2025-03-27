<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Get the users associated with this role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($role) {
            $role->slug = Str::slug($role->name);
        });
    }
    /**
     * Check if role has specific permission
     */
    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions);
    }
}
