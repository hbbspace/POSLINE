<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnggotaKeluargaModel;
use App\Models\BalitaModel;
use App\Models\HasilPemeriksaanModel;
use Illuminate\Http\Request;
use App\Models\PemeriksaanModel;
use Carbon\Carbon;
use Yajra\DataTables\Facades\DataTables;

class JadwalPemeriksaanController extends Controller
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
        return view('admin.jadwal.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jadwal_pemeriksaan' => $jadwal_pemeriksaan, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Jadwal',
            'list' => ['Home', 'Jadwal', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Jadwal baru'
        ];

        $jadwal_pemeriksaan = PemeriksaanModel::all();
        $activeMenu = 'jadwal';

        return view('admin.jadwal.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'jadwal' => $jadwal_pemeriksaan, 'activeMenu' => $activeMenu]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'agenda' => 'required|string|min:3',
            'tempat' => 'required|string|max:100',
            'tanggal' => 'required|date',
        ]);
    
        // Buat entri baru di tabel hasil pemeriksaan
        $pemeriksaan = PemeriksaanModel::create([
            'agenda' => $request->agenda,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
        ]);
        //menghapus seluruh hasil pemeriksaan 3 minggu kebelakang dengan syarat bayi tidak mengikuti pemeriksaan
        $pemerisaanTerakhir=PemeriksaanModel::max('pemeriksaan_id');
        $deleteHasilPemeriksaanById=$pemerisaanTerakhir-3;
        HasilPemeriksaanModel::whereNull('admin_id')->where('pemeriksaan_id',$deleteHasilPemeriksaanById)->delete();
        
        // Dapatkan semua balita
        $umur60BulanSebelumnya = Carbon::now()->subMonths(60);
        
        $balitas = AnggotaKeluargaModel::where('status', 'anak')
            ->where('tanggal_lahir', '>=', $umur60BulanSebelumnya)
            ->get();
            
        // Iterasi melalui setiap balita
        foreach ($balitas as $balita) {
            // Buat entri baru di tabel hasil pemeriksaan untuk setiap balita
            HasilPemeriksaanModel::create([
                'nik' => $balita->nik,
                'pemeriksaan_id' => $pemeriksaan->pemeriksaan_id,
                'status'=>'Terdaftar'
                // Anda juga bisa menambahkan atribut lain yang diperlukan di sini
            ]);
        }
    
        return redirect('admin/jadwal')->with('success', 'Data Anak berhasil disimpan');
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

        $activeMenu = 'jadwal';

        return view('admin.jadwal.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'jadwal_pemeriksaan' => $jadwal_pemeriksaan, 'activeMenu' => $activeMenu]);
    }

    public function edit($pemeriksaan_id)
    {
        $jadwal_pemeriksaan = PemeriksaanModel::find($pemeriksaan_id);

        $breadcrumb = (object) [
            'title' => 'Edit Jadwal',
            'list' => ['Home', 'Jadwal', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Jadwal'
        ];

        $activeMenu = 'jadwal';

        return view('admin.jadwal.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'jadwal_pemeriksaan' => $jadwal_pemeriksaan, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, $pemeriksaan_id)
    {
        $request->validate([
            'agenda' => 'required|string|min:3',
            'tempat' => 'required|string|max:100',
            'tanggal' => 'required|date',
        ]);

        PemeriksaanModel::where('pemeriksaan_id', $pemeriksaan_id)->update([
            'agenda' => $request->agenda,
            'tempat' => $request->tempat,
            'tanggal' => $request->tanggal,
        ]);

        return redirect('admin/jadwal')->with('success', 'Data Jadwal berhasil diubah');
    }

    public function destroy($pemeriksaan_id)
    {
        $check = PemeriksaanModel::find($pemeriksaan_id);
        if (!$check) {
            return redirect('admin/jadwal')->with('error', 'Data Jadwal tidak ditemukan');
        }else{

            HasilPemeriksaanModel::where('pemeriksaan_id',$pemeriksaan_id)->delete();
            PemeriksaanModel::where('pemeriksaan_id',$pemeriksaan_id)->delete();
            return redirect('admin/jadwal')->with('success', 'Data Jadwal Berhasil dihapus');

        }


        // try {
        //     PemeriksaanModel::destroy($pemeriksaan_id);
        //     return redirect('admin/jadwal')->with('success', 'Data Jadwal berhasil dihapus');
        // } catch (\Illuminate\Database\QueryException $e) {
        //     return redirect('admin/jadwal')->with('error', 'Data Jadwal gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        // }
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
            ->addColumn('aksi', function ($jadwal_pemeriksaan) { // menambahkan kolom aksi
                $btn = '<a href="' . url('admin/jadwal/' . $jadwal_pemeriksaan->pemeriksaan_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('admin/jadwal/' . $jadwal_pemeriksaan->pemeriksaan_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/jadwal/' . $jadwal_pemeriksaan->pemeriksaan_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                
                return $btn;
            })
            ->addColumn('Rangking', function($jadwal_pemeriksaan) { // menambahkan kolom Rangking
                $btn = '<a href="' . url('admin/jadwal/prosesSPK/' . $jadwal_pemeriksaan->pemeriksaan_id) . '" class="btn btn-success btn-sm">Proses</a> ';
                return $btn;
            })
            ->rawColumns(['aksi', 'Rangking']) // memberitahu bahwa kolom aksi dan Rangking adalah HTML
            ->make(true);
    }
    

}    
