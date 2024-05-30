<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemeriksaanModel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class JadwalUserController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Pemeriksaan',
            'list' => ['Home', 'Jadwal']
        ];

        $page = (object) [
            'title' => 'Daftar Agenda Pemeriksaan'
        ];

        $activeMenu = 'jadwal';

        $jadwal_pemeriksaan = PemeriksaanModel::all();
        return view('user.jadwal.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jadwal_pemeriksaan' => $jadwal_pemeriksaan, 'activeMenu' => $activeMenu]);
    }


    public function list(Request $request)
    {
        $query = PemeriksaanModel::query();

        if ($request->tanggal) {
            $query->where('tanggal', $request->tanggal);
        }
    
        $jadwal_pemeriksaan = $query->get();
    
        return DataTables::of($jadwal_pemeriksaan)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('Keterangan', function ($jadwal_pemeriksaan) { // menambahkan kolom aksi
                $tanggal_pemeriksaan = Carbon::parse($jadwal_pemeriksaan->tanggal);
    
                if ($tanggal_pemeriksaan->isFuture()) {
                    $btn = '<a class="btn btn-primary btn-sm">Akan Dilaksanakan</a> ';
                } elseif ($tanggal_pemeriksaan->isToday()) {
                    $btn = '<a class="btn btn-success btn-sm">Sedang Dilaksanakan</a> ';
                } else {
                    $btn = '<a class="btn btn-danger btn-sm">Telah Dilaksanakan</a> ';
                }
    
                return $btn;
            })
            ->rawColumns(['Keterangan']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function listDashboard()
    {
        $jadwal_pemeriksaan = PemeriksaanModel::select('pemeriksaan_id', 'agenda', 'tanggal', 'tempat')
        ->where('tanggal', '>=', now())
        ->get();
        
    
        return DataTables::of($jadwal_pemeriksaan)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->make(true);
    }


    
}    
