<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnggotaKeluargaModel extends Model
{
    use HasFactory;

    protected $table = 'anggota_keluarga';
    protected $primaryKey = 'nik';
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'no_kk',
        'nama',
        'tanggal_lahir',
        'jk',
        'status',
    ];

    public function keluarga(): BelongsTo
    {
        return $this->belongsTo(KeluargaModel::class, 'no_kk');
    }
}
