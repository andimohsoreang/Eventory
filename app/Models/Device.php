<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'brand_id',
        'sticekr',
        'foto_depan',
        'foto_belakang',
        'foto_terpasang',
        'foto_serial',
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

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Relasi dengan model Tipe (tipe perangkat)
     */
    public function tipe()
    {
        return $this->belongsTo(Tipe::class);
    }

}
