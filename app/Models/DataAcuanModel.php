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
        'BB-L_min',
        'BB-P_min',
        'TB-L_min',
        'TB-P_min',
        'LB-L_min',
        'LB-P_min'
    ];
}
