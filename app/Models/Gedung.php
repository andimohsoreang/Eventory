<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gedung extends Model
{
    use HasFactory;

    // Menentukan bahwa kolom yang dapat diisi adalah name, lokasi, parent_id, dan photo
    protected $fillable = ['name', 'lokasi', 'parent_id', 'photo'];

    /**
     * Mendefinisikan relasi dengan gedung induk (parent)
     */
    public function parent()
    {
        return $this->belongsTo(Gedung::class, 'parent_id');
    }

    public function location()
    {
        return $this->hasMany(Location::class);
    }
    /**
     * Mendefinisikan relasi dengan gedung anak (children)
     */
    public function children()
    {
        return $this->hasMany(Gedung::class, 'parent_id');
    }

    /**
     * Mendapatkan URL lengkap untuk foto gedung.
     */
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : null;
    }
}
