<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pendaftaran extends Model
{
    public const STATUS = [
        'Menunggu' => 'Menunggu',
        'Diperiksa' => 'Diperiksa',
        'Selesai' => 'Selesai',
        'Batal' => 'Batal',
    ];

    protected $table = 'pendaftaran';

    protected $fillable = [
        'pasien_id',
        'dokter_id',
        'tanggal_daftar',
        'keluhan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_daftar' => 'date',
        ];
    }

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(Pasien::class);
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(Dokter::class);
    }
}

