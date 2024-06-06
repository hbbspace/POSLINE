@extends('admin.layouts.template')

@section('subtitle', 'Admin')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Admin')

@section('content')
<div class="table-responsive" style="max-height: 570px; overflow-y: auto;">
    <div class="container col-lg-12">
        <div class="card card-info">
            <div class="card-header bg-info text-white">
                <h3 class="card-title">Dashboard</h3>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Small boxes (Stat box) -->
                        <div class="col-lg-6 col-md-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $anakTerdaftar }}</h3>
                                    <p>Anak Terdaftar</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="{{ url('/admin/dataAnak') }}" class="small-box-footer">
                                    Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Kolom yang sama -->
                        <!-- Small box 1 -->
                        <div class="col-lg-6 col-md-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>{{ $jumlahKK }}</h3>
                                    <p>Jumlah KK Terdaftar</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="{{ url('/admin/dataKeluarga') }}" class="small-box-footer">
                                    Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Small box 2 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $jumlahPemeriksaan }}</h3>
                                    <p>Jumlah Pemeriksaan</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-medkit"></i>
                                </div>
                                <a href="{{ url('/admin/dataPemeriksaan') }}" class="small-box-footer">
                                    Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Small box 3 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $ortuTerdaftar }}</h3>
                                    <p>Orang Tua Terdaftar</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person"></i>
                                </div>
                                <a href="{{ url('/admin/dataIbu') }}" class="small-box-footer">
                                    Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Small box 4 -->
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $jadwalTerlaksana }}</h3>
                                    <p>Jadwal Terlaksana</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-calendar"></i>
                                </div>
                                <a href="{{ url('/admin/jadwal') }}" class="small-box-footer">
                                    Detail <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- Chart Box -->
                        <div class="col-lg-4">
                            <div class="card card-info">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title">Perbandingan Berat Balita</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="beratChart" width="400" height="423"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-info">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title">Perbandingan Tinggi Balita</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="tinggiChart" width="400" height="423"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-info">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title">Perbandingan Balita Stunting dan Tidak Stunting</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="stuntingChart" width="400" height="200"></canvas>
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
            <div class="card-header bg-info text-white">
                <a href="{{ url('/admin/jadwal') }}">
                    <h3 class="card-title">Jadwal Terbaru</h3>
                </a>
            </div>
            <div class="card-body">
                <section class="content">
                    <table class="table table-bordered table-striped table-hover table-sm" id="table_jadwal">
                        <thead class="thead-info">
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
            <div class="card-header bg-info text-white">
                <h3 class="card-title">Perbandingan Seluruh Pemeriksaan</h3>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-6 mt-3">
                            <div class="card card-info">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title">Perbandingan Tinggi Balita</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id="heightChart" width="400" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-3">
                            <div class="card card-info">
                                <div class="card-header bg-info text-white">
                                    <h3 class="card-title">Perbandingan Berat Balita</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
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
    document.addEventListener('DOMContentLoaded', function () {
        var ctx = document.getElementById('stuntingChart').getContext('2d');
        var tinggiChart = new Chart(ctx, {
            type: 'pie', // 'Pie' diganti menjadi 'pie' (kecil)
            data: {
                labels: ['Tidak Stunting', 'Rendah', 'Sedang', 'Tinggi'],
                datasets: [{
                    data: [{{ $tidakStunting->first()->stunting ?? 0 }}, 
                           {{ $stuntingRendah->first()->stunting ?? 0 }}, 
                           {{ $stuntingSedang->first()->stunting ?? 0 }},
                           {{ $stuntingTinggi->first()->stunting ?? 0 }}],
                    backgroundColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0'], // Ditambahkan warna untuk semua kategori
                    borderColor: ['#36A2EB', '#FF6384', '#FFCE56', '#4BC0C0'], // Ditambahkan warna untuk semua kategori
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom' // Posisi legenda diubah menjadi 'bottom'
                    }
                }
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
                var ctxHeight = document.getElementById('heightChart').getContext('2d');
                var heightChart = new Chart(ctxHeight, {
                    type: 'line',
                    data: {
                        labels: response.labels,
                        datasets: [
                            {
                                label: 'Tinggi Rata-rata Laki-laki',
                                data: response.data,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                fill: false
                            },
                            {
                                label: 'Tinggi Rata-rata Perempuan',
                                data: response.data2,
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

                var ctxWeight = document.getElementById('weightChart').getContext('2d');
var weightChart = new Chart(ctxWeight, {
type: 'line',
data: {
labels: response.labels,
datasets: [
{
label: 'Berat Rata-rata Laki-laki',
data: response.weightL,
backgroundColor: 'rgba(54, 162, 235, 0.2)',
borderColor: 'rgba(54, 162, 235, 1)',
borderWidth: 1,
fill: false
},
{
label: 'Berat Rata-rata Perempuan',
data: response.weightP,
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


