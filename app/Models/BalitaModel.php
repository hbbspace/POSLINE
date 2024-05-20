<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BalitaModel extends Model
{
    protected $table = 'balita';
    public $timestamps = true;
    protected $primaryKey = 'balita_id';

    protected $fillable = [
        'nik',
        'tinggi_badan',
        'berat_badan',
        'lingkar_kepala'
    ];
    public function anggota_keluarga(): BelongsTo
    {
        return $this->belongsTo(AnggotaKeluargaModel::class, 'nik');
    }
}