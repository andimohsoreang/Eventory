<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Brand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'slug',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = $category->slug ?? Str::slug($category->name);
        });
    }

    public function alat()
    {
        return $this->hasMany(Device::class);
    }
}
