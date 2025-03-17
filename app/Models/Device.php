<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipe_id',
        'device_id',
        'qr',
        'isActive',
        'category_dana_id',
        'sticekr'
    ];

    public function location()
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Handle the "creating" event to generate QR code.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($device) {
            // Generate QR code when creating the device
            if (empty($device->qr)) {
                $device->qr = QrCode::generate('http://127.0.0.1:8000/device/' . $device->device_id);
            }
        });
    }

    public function categoryDana()
    {
        return $this->belongsTo(CategoryDana::class);
    }

    /**
     * Relasi dengan model Tipe (tipe perangkat)
     */
    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }

    /**
     * Relasi dengan model Gedung (gedung tempat perangkat berada)
     */

    /**
     * Mendapatkan URL untuk QR code dalam format Base64.
     */
}
