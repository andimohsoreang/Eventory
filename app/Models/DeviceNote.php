<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
        'description'
    ];

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
} 