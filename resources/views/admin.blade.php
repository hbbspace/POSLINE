@extends('admin.layouts.template')

@section('subtitle', 'Admin')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Admin')

@section('content')
<div class="table-responsive" style="max-height: 570px; overflow-y: auto;">
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
                                    <h3>Anak yang Terdaftar</h3>
                                    <p>{{ $anakTerdaftar }} Orang Balita</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a class="small-box-footer" href="{{ url('/admin/dataAnak') }}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>Jumlah KK Terdaftar</h3>
                                    <p>{{ $jumlahKK }} KK</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a class="small-box-footer" href="{{ url('/admin/dataKeluarga') }}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Jumlah Pemeriksaan</h3>
                                    <p>{{ $jumlahPemeriksaan }} Hasil Pemeriksaan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-medkit"></i>
                                </div>
                                <a class="small-box-footer" href="{{ url('/admin/dataPemeriksaan') }}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Orang Tua Terdaftar</h3>
                                    <p>{{ $ortuTerdaftar }} Orang tua</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a class="small-box-footer" href="{{ url('/admin/dataIbu') }}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Jadwal Terlaksana</h3>
                                    <p>{{ $jadwalTerlaksana }} Jadwal</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-calendar"></i>
                                </div>
                                <a class="small-box-footer" href="{{ url('/admin/jadwal') }}">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Chart Box -->
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
                <a href="{{ url('/admin/jadwal') }}">
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
    <div class="container col-lg-12">
        <div class="card card-info">
            <div class="card-header">
                <h3>Perbandingan Seluruh Pemeriksaan</h3>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3>Perbandingan Tinggi Balita</h3>
                                </div>
                                <div class="card-body">
                                    <div style="width: 100%; max-width: 600px; margin: 0 auto;">
                                        <canvas id="heightChart" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3>Perbandingan Berat Balita</h3>
                                </div>
                                <div class="card-body">
                                    <div style="width: 100%; max-width: 600px; margin: 0 auto;">
                                        <canvas id="weightChart" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ route('admin.chart.data') }}",
            method: 'GET',
            success: function(response) {
                // Grafik Tinggi Balita
                var ctxHeight = document.getElementById('heightChart').getContext('2d');
                var heightChart = new Chart(ctxHeight, {
                    type: 'line',
                    data: {
                        labels: response.labels, // Menggunakan label yang sama untuk kedua dataset
                        datasets: [
                            {
                                label: 'Tinggi Rata-rata Laki-laki',
                                data: response.data, // Data tinggi rata-rata laki-laki
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                fill: false
                            },
                            {
                                label: 'Tinggi Rata-rata Perempuan',
                                data: response.data2, // Data tinggi rata-rata perempuan
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                fill: false
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Grafik Berat Balita
                var ctxWeight = document.getElementById('weightChart').getContext('2d');
                var weightChart = new Chart(ctxWeight, {
                    type: 'line',
                    data: {
                        labels: response.labels, // Menggunakan label yang sama untuk kedua dataset
                        datasets: [
                            {
                                label: 'Berat Rata-rata Laki-laki',
                                data: response.weightL, // Data berat rata-rata laki-laki
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                fill: false
                            },
                            {
                                label: 'Berat Rata-rata Perempuan',
                                data: response.weightP, // Data berat rata-rata perempuan
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 1,
                                fill: false
                            }
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    });
</script>

@endpush
