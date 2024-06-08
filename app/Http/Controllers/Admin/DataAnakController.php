<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\KeluargaModel;
use App\Models\AnggotaKeluargaModel;
use App\Models\BalitaModel;
use App\Models\HasilPemeriksaanModel;
use App\Models\KeluargaModel;
use App\Models\PemeriksaanModel;
use Yajra\DataTables\Facades\DataTables;

class DataAnakController extends Controller
{
    public function index()
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Anak',
            'list' => ['Home', 'Anak']
        ];

        $page = (object) [
            'title' => 'Daftar Anak yang terdaftar dalam sistem'
        ];

        $activeMenu = 'dataAnak';

        $anggota_keluarga = AnggotaKeluargaModel::all();
        return view('admin.dataAnak.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function create()
    {
        $breadcrumb = (object) [
            'title' => 'Tambah Anak',
            'list' => ['Home', 'Anak', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Anak baru'
        ];

        $kk=KeluargaModel::all();
        $anggota_keluarga = AnggotaKeluargaModel::all();
        $activeMenu = 'dataAnak';

        return view('admin.dataAnak.create', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'keluarga' => $anggota_keluarga, 'kk'=>$kk, 'activeMenu' => $activeMenu]);
    }


    public function store(Request $request)
    {
        // Validasi data masukan
        $request->validate([
            'no_kk' => 'required|string|min:3', // 'exists' memastikan no_kk ada di tabel referensi
            'nik' => 'required|string|min:3', // 'unique' tidak diperlukan karena kita melakukan pemeriksaan manual
            'nama' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jk' => 'required|in:L,P',
            'status' => 'required|in:Anak'
        ]);
    
        // Periksa apakah NIK sudah ada di tabel anggota_keluarga
        $existingMember = AnggotaKeluargaModel::where('nik', $request->nik)->first();
        if ($existingMember) {
            return redirect()->back()->withErrors(['nik' => 'NIK sudah terdaftar dalam anggota keluarga.'])->withInput();
        }
    
        // Tambahkan data anak baru ke tabel anggota_keluarga
        AnggotaKeluargaModel::create([
            'no_kk' => $request->no_kk,
            'nik' => $request->nik,
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jk' => $request->jk,
            'status' => $request->status
        ]);
    
        //create hasil pemeriksaan baru bagi balita yang baru terdaftar terhadap pemeriksaan posyandu yang belum dilaksanakan
        $pemeriksaan = PemeriksaanModel::select('pemeriksaan_id')->where('tanggal', '>=', now())->get();
    
        foreach ($pemeriksaan as $pemeriksaans) {
            HasilPemeriksaanModel::create([
                'nik' => $request->nik,
                'pemeriksaan_id' => $pemeriksaans->pemeriksaan_id,
                'status' => 'Terdaftar'
                // Anda juga bisa menambahkan atribut lain yang diperlukan di sini
            ]);
        }
    
        return redirect('admin/dataAnak')->with('success', 'Data Anak berhasil disimpan');
    }
    
    

    public function show($no_kk)
    {
        $anggota_keluarga = AnggotaKeluargaModel::with('keluarga')->find($no_kk);
        $breadcrumb = (object) [
            'title' => 'Detail Anak',
            'list' => ['Home', 'Anak', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Anak'
        ];

        $activeMenu = 'dataAnak';

        return view('admin.dataAnak.show', ['breadcrumb' => $breadcrumb,
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga, 'activeMenu' => $activeMenu]);
    }

    public function edit($nik)
    {
        $anggota_keluarga = AnggotaKeluargaModel::find($nik);

        $breadcrumb = (object) [
            'title' => 'Edit Anak',
            'list' => ['Home', 'Anak', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Anak'
        ];

        $activeMenu = 'dataAnak';
        $kk=KeluargaModel::all();


        return view('admin.dataAnak.edit', ['breadcrumb' => $breadcrumb, 
         'page' => $page, 'anggota_keluarga' => $anggota_keluarga,'kk'=>$kk, 'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, String $id)
    {
        $request->validate([
            'nama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nik' => 'required|string|min:3', // 'unique' tidak diperlukan karena kita melakukan pemeriksaan manual
            'jk' => 'required|in:L,P',
            'status' => 'required|in:anak',
            'no_kk' => 'required|string|min:3'
        ]);
    
        $anggota_keluarga = AnggotaKeluargaModel::find( $id);
    
        if (!$anggota_keluarga) {
            return redirect('admin/dataAnak')->with('error', 'Data Anak tidak ditemukan');
        }
        $existingMember = AnggotaKeluargaModel::where('nik', $request->nik)->first();
        if ($existingMember) {
            return redirect('admin/dataAnak/')->with('error', 'Tidak dapat mengganti NIK, karena NIK sudah dipakai');
        }
        $anggota_keluarga->tanggal_lahir = $request->tanggal_lahir;
        $anggota_keluarga->no_kk = $request->no_kk;
        $anggota_keluarga->jk = $request->jk;
        $anggota_keluarga->nik = $request->nik;
        $anggota_keluarga->nama = $request->nama;
        $anggota_keluarga->status = $request->status;

        $anggota_keluarga->save();

        // $anggota_keluarga->update([
        //     'nama' => $request->nama,
        //     'tanggal_lahir' => $request->tanggal_lahir,
        //     'jk' => $request->jk,
        //     'status' => $request->status,
        //     'no_kk' => $request->no_kk
        // ]);
    
        return redirect('admin/dataAnak')->with('success', 'Data Anak berhasil diubah');
    }

    public function destroy($nik)
    {
        $check = AnggotaKeluargaModel::find($nik);
        if (!$check) {
            return redirect('admin/dataAnak')->with('error', 'Data Anak tidak ditemukan');
        }else{
            HasilPemeriksaanModel::whereIn('nik', $check)->delete();
            AnggotaKeluargaModel::whereIn('nik', $check)->delete();
            return redirect('admin/dataAnak')->with('success', 'Data Anak berhasil dihapus');
        }

        // try {
        //     AnggotaKeluargaModel::destroy($nik);
        // } catch (\Illuminate\Database\QueryException $e) {
        //     return redirect('admin/dataAnak')->with('error', 'Data Anak gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        // }
    }

    public function list(Request $request)
    {
        $query = AnggotaKeluargaModel::where('status', 'anak');
    
        if ($request->nama) {
            $query->where('nama', $request->nama);
        }
    
        $anggota_keluargas = $query->get();
    
        return DataTables::of($anggota_keluargas)
            ->addIndexColumn() // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
            ->addColumn('aksi', function ($anggota_keluarga) { // menambahkan kolom aksi
                $btn = '<a href="' . url('admin/dataAnak/' .$anggota_keluarga->nik) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('admin/dataAnak/' .$anggota_keluarga->nik . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('admin/dataAnak/' .$anggota_keluarga->nik) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }
    
}    
