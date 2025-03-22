<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategoryDana extends Model
{
    use HasFactory;
    protected $table = 'category_dana'; 

    protected $fillable = [
        'name',
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
