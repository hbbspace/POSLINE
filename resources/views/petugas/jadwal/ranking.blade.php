@extends('petugas.layouts.template')
@section('content')
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title">Ranking Balita yang Perlu Bantuan</h3>
        <div class="card-tools">        
            <a href="{{ url('petugas/jadwal') }}" class="btn btn-sm btn-primary">Kembali</a>
        </div>
    </div>
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span class="">{{ session('success') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="">{{ session('error') }}</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <table class="table table-bordered table-striped table-hover table-sm" id="table_ranking">
            <thead>
                <h3>Matrix Nilai</h3>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    {{-- <th>Nama Orang Tua</th> --}}
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Orang Tua</th>
                    <th>Malnutrisi</th>
                    <th>Stunting</th>
                    <th>Pendapatan Orang Tua</th>
                    <th>Riwayat Penyakit</th>
                    {{-- <th>Ranking</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $n = count($kriteria);
                $n2 = count($rankingBalita);
                foreach ($rankingBalita as $index => $balita) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $balita->nama . "</td>";
                    echo "<td>" . $balita->usia . "</td>";
                    echo "<td>" . $nilai[$i][0] . "</td>";
                    echo "<td>" . $nilai[$i][1] . "</td>";
                    echo "<td>" . $nilai[$i][2] . "</td>";
                    echo "<td>" . $nilai[$i][3] . "</td>";
                    echo "<td>" . $nilai[$i][4] . "</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_ranking">
            <thead>
                <h3>Normalisasi Nilai</h3>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    {{-- <th>Nama Orang Tua</th> --}}
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Orang Tua</th>
                    <th>Malnutrisi</th>
                    <th>Stunting</th>
                    <th>Pendapatan Orang Tua</th>
                    <th>Riwayat Penyakit</th>
                    {{-- <th>Ranking</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $n = count($kriteria);
                $n2 = count($rankingBalita);
                foreach ($rankingBalita as $index => $balita) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $balita->nama . "</td>";
                    echo "<td>" . $balita->usia . "</td>";
                    echo "<td>" . $normalisasi[$i][0] . "</td>";
                    echo "<td>" . $normalisasi[$i][1] . "</td>";
                    echo "<td>" . $normalisasi[$i][2] . "</td>";
                    echo "<td>" . $normalisasi[$i][3] . "</td>";
                    echo "<td>" . $normalisasi[$i][4] . "</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_ranking">
            <thead>
                <h3>Utility</h3>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    {{-- <th>Nama Orang Tua</th> --}}
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Orang Tua</th>
                    <th>Malnutrisi</th>
                    <th>Stunting</th>
                    <th>Pendapatan Orang Tua</th>
                    <th>Riwayat Penyakit</th>
                    {{-- <th>Ranking</th> --}}
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                $n = count($kriteria);
                $n2 = count($rankingBalita);
                foreach ($rankingBalita as $index => $balita) {
                    echo "<tr>";
                    echo "<td>" . ($index + 1) . "</td>";
                    echo "<td>" . $balita->nama . "</td>";
                    echo "<td>" . $balita->usia . "</td>";
                    echo "<td>" . $utility[$i][0] . "</td>";
                    echo "<td>" . $utility[$i][1] . "</td>";
                    echo "<td>" . $utility[$i][2] . "</td>";
                    echo "<td>" . $utility[$i][3] . "</td>";
                    echo "<td>" . $utility[$i][4] . "</td>";
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
        <table class="table table-bordered table-striped table-hover table-sm" id="table_ranking">
            <thead>
                <h3>Hasil Akhir</h3>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    {{-- <th>Nama Orang Tua</th> --}}
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Orang Tua</th>
                    <th>Malnutrisi</th>
                    <th>Stunting</th>
                    <th>Pendapatan Orang Tua</th>
                    <th>Riwayat Penyakit</th>
                    <th>Ranking</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rankingBalita as $index => $balita)
                <tr @if($index < 5) style="background-color: yellow;" @endif>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $balita->nama }}</td>
                    <td>{{ $balita->usia }}</td>
                    <td>{{ $balita->jam_kerja }}</td>
                    <td>{{ $balita->malnutrisi }}</td>
                    <td>{{ $balita->stunting }}</td>
                    <td>{{ $balita->pendapatan }}</td>
                    <td>{{ $balita->riwayat_penyakit }}</td>
                    <td>{{ $balita->ranking }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
    <!-- Tempatkan CSS kustom di sini jika diperlukan -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('#table_ranking').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@endpush
