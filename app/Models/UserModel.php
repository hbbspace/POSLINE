<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Authenticable
{
    use HasFactory;

    protected $table = 'user';
    protected $primaryKey = 'user_id';
    public $timestamps = false;

    protected $fillable = [
        'nik',
        'password',
        'username',
    ];

    protected $hidden = [
        'password',
    ];
    public function anggota_keluarga(): BelongsTo
    {
        return $this->belongsTo(AnggotaKeluargaModel::class, 'nik');
    }
}