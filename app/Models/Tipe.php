<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'file', // Model 3D file path
        'icon',
        'isRuckus'
    ];

    /**
     * Handle the "creating" event to set slug from name.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tipe) {
            $tipe->slug = $tipe->slug ?? Str::slug($tipe->name);
        });
    }

    /**
     * Relasi dengan model Device
     */
    public function device()
    {
        return $this->hasMany(Device::class);
    }

    /**
     * Get the full URL to the 3D model file.
     */
    public function getFileUrlAttribute()
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }
    
}
