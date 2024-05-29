@extends('petugas.layouts.template')

@section('subtitle', 'Petugas Posyandu')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Petugas Posyandu')

@section('content')
<div class="container col-lg-12">
    <div class="card card-info">
        <div class="card-header">
            <h3>Dashboard</h3>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>Total Pemeriksaan</h3>
                                <p>{{ $total_pemeriksaan }} Pemeriksaan yang telah anda lakukan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-trophy"></i>
                            </div>
                            <a href="{{ url('/petugas/historyPemeriksaan') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Jadwal yang telah dilaksanakan</h3>
                                <p>{{ $total_jadwal }} jadwal Pemeriksaan telah dilaksanakan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-trophy"></i>
                            </div>
                            <a class="small-box-footer">
                                <i class="fas fa-arrow-circle-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3>Perbandingan Berat Balita</h3>
                            </div>
                            <div class="card-body">
                                <div style="width: 100%; max-width: 600px; margin: 0 auto;">
                                    <canvas id="beratChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3>Perbandingan Tinggi Balita</h3>
                            </div>
                            <div class="card-body">
                                <div style="width: 100%; max-width: 600px; margin: 0 auto;">
                                    <canvas id="tinggiChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container col-lg-12 mt-4">
    <div class="card card-info">
        <div class="card-header">
            <a href="{{ url('/petugas/jadwal')}}">
                <h3>Jadwal Terbaru</h3>
            </a>
        </div>
        <div class="card-body">
            <section class="content">
                <table class="table table-bordered table-striped table-hover table-sm" id="table_jadwal">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pemeriksaan ID</th>
                            <th>Agenda</th>
                            <th>Tanggal</th>
                            <th>Tempat</th>
                        </tr>
                    </thead>
                </table>
            </section>
        </div>
    </div>
</div>
@endsection

@push('css')
<!-- Tambahkan CSS tambahan di sini -->
@endpush

@push('js')
<script>
    $(document).ready(function() {
        $('#table_jadwal').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ url('user/jadwal/listDashboard') }}",
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    data: null,
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Nomor indeks baris dimulai dari 0, jadi tambahkan 1
                    }
                },
                {
                    data: "pemeriksaan_id",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "agenda",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tanggal",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "tempat",
                    className: "",
                    orderable: true,
                    searchable: true
                }
            ],
            dom: 'rtip' // Menghilangkan search bar dan show entries

        });
    });
</script>
@endpush


@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('beratChart').getContext('2d');
        var beratChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Laki-laki' , 'Perempuan'],
                datasets: [{
                    label: 'Berat Rata-rata (Kg)',
                    data: [{{ $beratRataLaki }}, {{ $beratRataPerempuan }}],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    borderColor: ['#36A2EB', '#FF6384'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: true
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('tinggiChart').getContext('2d');
        var tinggiChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Laki-laki' , 'Perempuan'],
                datasets: [{
                    label: 'Tinggi Rata-rata (Cm)',
                    data: [{{ $tinggiRataLaki }}, {{ $tinggiRataPerempuan }}],
                    backgroundColor: ['#36A2EB', '#FF6384'],
                    borderColor: ['#36A2EB', '#FF6384'],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: true
            }
        });
    });
</script>
@endpush