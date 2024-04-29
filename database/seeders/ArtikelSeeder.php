<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArtikelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('artikel')->insert([
            [
                'admin_id' => 1,
                'judul' => 'Tips Menjaga Kesehatan Balita',
                'konten' => '
                    <p>Menjaga kesehatan balita sangatlah penting untuk tumbuh kembangnya yang optimal. Berikut beberapa tips untuk menjaga kesehatan balita:</p>
                    <ul>
                        <li>Berikan ASI eksklusif selama 6 bulan pertama</li>
                        <li>Berikan makanan pendamping ASI (MPASI) yang bergizi dan seimbang setelah 6 bulan</li>
                        <li>Ajarkan balita untuk hidup bersih dan sehat</li>
                        <li>Rutin membawa balita ke posyandu atau puskesmas untuk mendapatkan imunisasi dan pemeriksaan kesehatan</li>
                        <li>Berikan kasih sayang dan perhatian yang cukup kepada balita</li>
                    </ul>
                ',
                'tgl_publikasi' => '2024-04-20',
                'gambar' => 'gambar-tips-kesehatan-balita.jpg',
            ],
            [
                'admin_id' => 2,
                'judul' => 'Pentingnya Imunisasi bagi Balita',
                'konten' => '
                    <p>Imunisasi merupakan salah satu upaya penting untuk menjaga kesehatan balita. Imunisasi dapat membantu melindungi balita dari berbagai penyakit berbahaya.</p>
                    <p>Berikut beberapa manfaat imunisasi bagi balita
                    <ul>
                        <li>Mencegah penyakit menular</li>
                        <li>Meningkatkan daya tahan tubuh balita</li>
                        <li>Memperkecil risiko komplikasi penyakit</li>
                        <li>Menurunkan angka kematian akibat penyakit menular</li>
                    </ul>
                    <p>Oleh karena itu, penting bagi orang tua untuk membawa balita ke posyandu atau puskesmas untuk mendapatkan imunisasi sesuai dengan jadwal yang telah ditentukan.</p>
                ',
                'tgl_publikasi' => '2024-04-27',
                'gambar' => 'gambar-pentingnya-imunisasi-balita.jpg',
            ],
        ]);
    }
}
