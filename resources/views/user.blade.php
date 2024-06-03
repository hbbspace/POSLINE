@extends('user.layouts.template')

@section('content')
<div class="table-responsive" style="max-height: 620px; overflow-y: auto;">
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
                                <h3>Balita</h3>
                                <p>{{ $jumlahAnak }} Jumlah Balita Anda Yang Terdaftar</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-trophy"></i>
                            </div>
                            <a href="{{ url('/user/dataBalitaUser') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>Total Pemeriksaan</h3>
                                <p>{{ $hasil_pemeriksaan }} Pemeriksaan telah dilakukan</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-trophy"></i>
                            </div>
                            <a href="{{ url('/user/dataPemeriksaanBalita') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="{{ url('/user/jadwal')}}">
                <h3>Jadwal Terbaru</h3>
            </a>
        </div>
        <div class="card-body">
            <section class="content">
                <table class="table table-bordered table-striped table-hover table-sm" id="table_jadwal">
                    <thead>
                        <tr>
                            <th>No</th>
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
<div class="container col-lg-12 mt-4">
    <div class="card card-info">
        <div class="card-header">
            <h3>Grafik Tinggi Badan</h3>
        </div>
        <div class="card-body">
            <canvas id="heightChart" width="650" height="150"></canvas> <!-- Atur panjang dan lebar grafik di sini -->
        </div>
    </div>
</div>
</div>
@endsection

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
$(document).ready(function() {
    $.ajax({
        url: "{{ route('user.chart.data') }}", // Sesuaikan dengan route yang telah Anda buat
        method: 'GET',
        success: function(response) {
            var ctx = document.getElementById('heightChart').getContext('2d');
            var datasets = [];
            var colors = [
                'rgba(54, 162, 235, 1)',  // Warna biru
                'rgba(255, 99, 132, 1)',  // Warna merah
                'rgba(75, 192, 192, 1)',  // Warna hijau
                'rgba(153, 102, 255, 1)', // Warna ungu
                'rgba(255, 159, 64, 1)',  // Warna oranye
                'rgba(255, 206, 86, 1)'   // Warna kuning
            ];

            var colorIndex = 0;
            for (var nama in response) {
                datasets.push({
                    label: nama,
                    data: response[nama].data,
                    fill: false,
                    borderColor: colors[colorIndex % colors.length],
                    tension: 0.5
                });
                colorIndex++;
            }

            var heightChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: response[Object.keys(response)[0]].labels,
                    datasets: datasets
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
