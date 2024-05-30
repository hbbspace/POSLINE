<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAcuanModel extends Model
{
    use HasFactory;
    
    protected $table = 'data_acuan';
    public $timestamps = false;
    protected $primaryKey = 'usia';

    protected $fillable = [
        'usia',
        'BB_L',
        'BB_P',
        'TB_L',
        'TB_P',
        'LB_L',
        'LB_P'
    ];
}
