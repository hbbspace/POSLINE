<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PemeriksaanModel;
use Yajra\DataTables\Facades\DataTables;

class jadwalUser extends Controller
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

        $activeMenu = 'user.jadwal';

        $jadwal_pemeriksaan = PemeriksaanModel::all();
        return view('user.jadwal.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jadwal_pemeriksaan' => $jadwal_pemeriksaan, 'activeMenu' => $activeMenu]);
    }

    public function show($pemeriksaan_id)
    {
        $jadwal_pemeriksaan = PemeriksaanModel::find($pemeriksaan_id);
        $breadcrumb = (object) [
            'title' => 'Detail Jadwal',
            'list' => ['Home', 'Jadwal', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Jadwal'
        ];

        $activeMenu = 'user.jadwal';

        return view('user.jadwal.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'jadwal_pemeriksaan' => $jadwal_pemeriksaan, 'activeMenu' => $activeMenu]);
    }

    public function list(Request $request)
    {
        $jadwal_pemeriksaan = PemeriksaanModel::select('pemeriksaan_id', 'agenda', 'tanggal', 'tempat');

        if ($request->pemeriksaan_id) {
            $jadwal_pemeriksaan->where('pemeriksaan_id', $request->pemeriksaan_id);
        }
    
        return DataTables::of($jadwal_pemeriksaan)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            // ->addColumn('aksi', function ($jadwal_pemeriksaan) { // menambahkan kolom aksi
            //     $btn = '<a href="'.url('user/jadwal', $jadwal_pemeriksaan->pemeriksaan_id).'" class="btn btn-info btn-sm">Detail</a> ';
            //     $btn .= '<a href="'.url('user/jadwal', $jadwal_pemeriksaan->pemeriksaan_id. '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            //     $btn .= '<form class="d-inline-block" method="POST" action="'. url('user/jadwal', $jadwal_pemeriksaan->pemeriksaan_id).'">'. csrf_field() . method_field('DELETE') .
            //         '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            //     return $btn;
            // })
            // ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
}    
