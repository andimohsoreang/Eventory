<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'gedung_id',
        'location',
        'device_id',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
