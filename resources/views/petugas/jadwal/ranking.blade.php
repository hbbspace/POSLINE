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
        <table class="table table-bordered table-striped table-hover table-sm" id="table_matrix">
            <thead>
                <h3>Matrix Nilai</h3>
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Ortu</th>
                    <th>Nafsu Makan</th>
                    <th>Stunting</th>
                    <th>Pendapatan Ortu</th>
                    <th>Gangguan Kesehatan</th>
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
                    for ($j = 0; $j < $n; $j++) {
                        echo "<td>" . $nilai[$i][$j] . "</td>";
                    }
                    echo "</tr>";
                    $i++;
                }
                foreach ($nilai as $row) {
                    $nilaiC1[] = $row[0];
                    $nilaiC2[] = $row[1];
                    $nilaiC3[] = $row[2];
                    $nilaiC4[] = $row[3];
                    $nilaiC5[] = $row[4];
                }

                if($nilai != null) {
                    // Menampilkan nilai minimum dan maksimum setiap kolom
                    echo "<tr>";
                    echo "<td colspan='3'>Bobot</td>";
                        echo "<td>" . $kriteria['jam_kerja'] . "</td>";
                        echo "<td>" . $kriteria['nafsu_makan'] . "</td>";
                        echo "<td>" . $kriteria['kondisi_stunting'] . "</td>";
                        echo "<td>" . $kriteria['kondisi_ekonomi'] . "</td>";
                        echo "<td>" . $kriteria['gangguan_kesehatan'] . "</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td colspan='3'>Min</td>";
                        echo "<td>" . min($nilaiC1) . "</td>";
                        echo "<td>" . min($nilaiC2) . "</td>";
                        echo "<td>" . min($nilaiC3) . "</td>";
                        echo "<td>" . min($nilaiC4) . "</td>";
                        echo "<td>" . min($nilaiC5) . "</td>";

                    echo "<tr>";
                    echo "<td colspan='3'>Max</td>";
                        echo "<td>" . max($nilaiC1) . "</td>";
                        echo "<td>" . max($nilaiC2) . "</td>";
                        echo "<td>" . max($nilaiC3) . "</td>";
                        echo "<td>" . max($nilaiC4) . "</td>";
                        echo "<td>" . max($nilaiC5) . "</td>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
        </table>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_normalisasi">
            <thead>
                <h3>Normalisasi Matrix</h3>
                <img src="{{ asset('img/normalisasi.png') }}" style="width: 18%" alt="Rumus Normalisasi" class="img-fluid" />
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Ortu</th>
                    <th>Nafsu Makan</th>
                    <th>Stunting</th>
                    <th>Pendapatan Ortu</th>
                    <th>Gangguan Kesehatan</th>
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
                    for ($j = 0; $j < $n; $j++) {
                        echo "<td>" . $normalisasi[$i][$j] . "</td>";
                    }
                    echo "</tr>";
                    $i++;
                }
                ?>
            </tbody>
        </table>
        

        <table class="table table-bordered table-striped table-hover table-sm" id="table_utility">
            <thead>
                <h3>Utility</h3>
                <img src="{{ asset('img/utility.png') }}" style="width: 20%" alt="Rumus Utility" class="img-fluid" />
                <tr>
                    <th>No</th>
                    <th>Nama Balita</th>
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Ortu</th>
                    <th>Nafsu Makan</th>
                    <th>Stunting</th>
                    <th>Pendapatan Ortu</th>
                    <th>Gangguan Kesehatan</th>
                    <th>Total</th>
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
                    for ($j = 0; $j < $n; $j++) {
                        echo "<td>" . $utility[$i][$j] . "</td>";
                    }
                    echo "<td class='total'>" . $totalNilai[$i] . "</td>";
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
                    <th>Usia (Bulan)</th>
                    <th>Jam Kerja Ortu</th>
                    <th>Nafsu Makan</th>
                    <th>Stunting</th>
                    <th>Pendapatan Ortu</th>
                    <th>Gangguan Kesehatan</th>
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
                    <td>{{ $balita->nafsu_makan }}</td>
                    <td>{{ $balita->stunting }}</td>
                    <td>{{ $balita->pendapatan }}</td>
                    <td>{{ $balita->gangguan_kesehatan }}</td>
                    <td>{{ $balita->ranking }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('css')
<style>
    .total {
        background-color: rgb(118, 247, 126); /* Or any color you prefer */
    }
</style>
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('#table_matrix').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
    $(document).ready(function() {
        $('#table_normalisasi').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
    $(document).ready(function() {
        $('#table_utility').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
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
