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
        'balita_id',
        'pemeriksaan_id',
        'admin_id',
        'tinggi_badan',
        'berat_badan',
        'lingkar_kepala',
        'nilai_kesehatan',
        'catatan'
    ];
}
