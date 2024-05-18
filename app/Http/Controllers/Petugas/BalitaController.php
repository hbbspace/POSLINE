<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\BalitaModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BalitaController extends Controller
{
    /**
     * Menampilkan daftar balita.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $breadcrumb = (object) [
            'title' => 'Daftar Balita',
            'list' => ['Home', 'Balita']
        ];

        $page = (object) [
            'title' => 'Daftar Balita yang terdaftar dalam sistem'
        ];

        $activeMenu = 'petugas.balita'; 
        $balita = BalitaModel::all();

        return view('petugas.balita.index', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page,
            'balita' => $balita, 
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request)
    {
        $balitas = BalitaModel::select('balita_id','nik', 'tinggi_badan', 'berat_badan', 'lingkar_kepala')->with('anggota_keluarga');

        if ($request->nik) {
            $balitas->where('nik', $request->nik);
        }

        return DataTables::of($balitas)
            ->addColumn('action', function ($balita) {
                return '<a href="' . url('petugas/balita/' . $balita->nik) . '" class="btn btn-info btn-sm">Detail</a> ' .
                    '<a href="' . url('petugas/balita/' . $balita->nik . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ' .
                    '<form class="d-inline-block" method="POST" action="' . url('petugas/balita/' . $balita->nik) . '">' .
                    csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            })
            ->make(true);
    }


    public function inputResult(Request $request, String $id)
    {
        $request->validate([
            'tinggi_badan' => 'required|numeric|max:150', 
            'berat_badan' => 'required|numeric|max:30', 
            'lingkar_kepala' => 'required|numeric|max:30' 
        ]);

        $balita = BalitaModel::find($id);
        if (!$balita) {
            return redirect()->back()->with('error', 'Balita tidak ditemukan');
        }

        $balita->update([
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'lingkar_kepala' => $request->lingkar_kepala
        ]);

        return redirect()->back()->with('success', 'Hasil balita berhasil disimpan');
    }

    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Balita',
            'list' => ['Home', 'Balita', 'Tambah']
        ];
        $page = (object)[
            'title' => 'Tambah Balita Baru'
        ];
        $balita = BalitaModel::all();
        $activeMenu = 'petugas.balita';
        return view('petugas.balita.create', ['balita' => $balita, 'breadcrumb' => $breadcrumb,
            'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|min:3|unique:balita,nik', 
            'tinggi_badan' => 'required|numeric|max:150', 
            'berat_badan' => 'required|numeric|max:30', 
            'lingkar_kepala' => 'required|numeric|max:30' 
        ]);

        BalitaModel::create([
            'nik' => $request->nik,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'lingkar_kepala' => $request->lingkar_kepala
        ]);

        return redirect('petugas/balita')->with('success', 'Data Balita berhasil disimpan');
    }

    public function show(String $nik)
    {
        $balita = BalitaModel::where('nik', $nik)->first();

        // Periksa apakah balita ditemukan
        if (!$balita) {
            return redirect()->back()->with('error', 'Balita tidak ditemukan');
        }

        $breadcrumb = (object) [
            'title' => 'Detail Balita',
            'list' => ['Home', 'Balita', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Petugas Posyandu'
        ];

        $activeMenu = 'petugas.balita';

        return view('petugas.balita.show', compact('balita', 'breadcrumb', 'page', 'activeMenu'));
    }

    public function update(Request $request, String $nik)
    {
        $request->validate([
            'nik' => 'required|string|min:3|unique:balita,nik', 
            'tinggi_badan' => 'required|numeric|max:150', 
            'berat_badan' => 'required|numeric|max:30', 
            'lingkar_kepala' => 'required|numeric|max:30' 
        ]);

        BalitaModel::find($nik)->update([
            'nik' => $request->nik,
            'tinggi_badan' => $request->tinggi_badan,
            'berat_badan' => $request->berat_badan,
            'lingkar_kepala' => $request->lingkar_kepala
        ]);

        return redirect('petugas/balita')->with('success', 'Data Balita berhasil diubah');
    }

    public function edit(String $nik)
    {
        $balita = BalitaModel::find($nik);

        $breadcrumb = (object) [
            'title' => 'Edit Data Balita Posyandu',
            'list' => ['Home', 'Balita', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Data Balita'
        ];

        $activeMenu = 'petugas.balita'; // set menu yang sedang aktif

        return view('petugas.balita.edit', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'balita' => $balita,
            'activeMenu' => $activeMenu
        ]);
    }
    
    public function destroy(String $nik)
    {
        $check = BalitaModel::find($nik);

        // Untuk mengecek apakah data user dengan id yang dimaksud ada atau tidak
        if (!$check) {
            return redirect('petugas/balita')->with('error', 'Data Balita tidak ditemukan');
        }

        try {
            BalitaModel::destroy($nik);
            return redirect('petugas/balita')->with('success', 'Data Balita berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            // Jika terjadi error ketika menghapus data, redirect kembali ke halaman dengan membawa pesan error
            return redirect('petugas/balita')->with('error', 'Data Balita gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}