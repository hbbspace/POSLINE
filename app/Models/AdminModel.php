<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class AdminModel extends Authenticable
{
    use HasFactory;

    protected $table = 'admin';
    protected $primaryKey = 'admin_id';
    public $timestamps = false;

    protected $fillable = [
        'username',
        'password',
        'nama_admin',
        'level',
        'jk',
    ];

    protected $hidden = [
        'password',
    ];}