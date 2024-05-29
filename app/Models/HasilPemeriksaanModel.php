<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPemeriksaanModel extends Model
{
    use HasFactory;
    
    protected $table = 'hasil_pemeriksaan';
    public $timestamps = false;
    protected $primaryKey = 'hasil_id';

    protected $fillable = [
        'hasil_id',
        'nik',
        'pemeriksaan_id',
        'admin_id',
        'usia',
        'tinggi_badan',
        'berat_badan',
        'lingkar_badan',
        'riwayat_penyakit',
        'malnutrisi',
        'stunting',
        'status',
        'ranking',
        'catatan'
    ];
}
