<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemeriksaanModel extends Model
{
    protected $table = 'pemeriksaan';
    public $timestamps = false;
    protected $primaryKey = 'pemeriksaan_id';

    protected $fillable = [
        'agenda',
        'tanggal',
        'tempat'
    ];
}
