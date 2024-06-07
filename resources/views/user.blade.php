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
                    <div class="row">
                        {{-- <div class="col-lg-6 col-6">
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
                        </div> --}}
                        <div class="col-lg-6 col-6">
                            <div class="small-box bg-light shadow-sm">
                                <div class="inner">
                                    <h3 class="text-info">Balita</h3>
                                    <p>{{ $jumlahAnak }} Jumlah Balita Anda Yang Terdaftar</p>
                                </div>
                                <div class="icon text-info">
                                    <i class="ion ion-trophy"></i>
                                </div>
                                <a href="{{ url('/user/dataBalitaUser') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    <div class="col-lg-6 col-6">
                        <div class="small-box bg-light shadow-sm">
                            <div class="inner">
                                <h3 class="text-info">Total Pemeriksaan</h3>
                                <p>{{ $hasil_pemeriksaan }} Pemeriksaan telah dilakukan</p>
                            </div>
                            <div class="icon text-info">
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
                <h3>Grafik Pemeriksaan Balita</h3>
            </div>
            <div class="card-body">
                <!-- Filter Section -->
                <div class="form-group row">
                    <label for="filterName" class="col-sm-2 col-form-label">Filter by Nama Balita</label>
                    <div class="col-sm-10">
                        <select class="form-control" id="filterName">
                            <option value="">Pilih Nama Balita</option>
                        </select>
                    </div>
                </div>
                <!-- Container for Charts -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="chart-container">
                            <h4>Grafik Tinggi Badan</h4>
                            <canvas id="heightChart" width="650" height="250"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="chart-container">
                            <h4>Grafik Berat Badan</h4>
                            <canvas id="weightChart" width="650" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{-- <div class="container col-lg-12 mt-4">
    <div class="card card-info">

    </div>
</div> --}}
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
        // Fetch list of Balita names
        $.ajax({
            url: "{{ route('user.balita.names') }}",
            method: 'GET',
            success: function(response) {
                response.forEach(function(name) {
                    $('#filterName').append(new Option(name, name));
                });
            }
        });

        var heightChart, weightChart; // Global variables to hold the chart instances

        function fetchChartData(nama_balita = '') {
            $.ajax({
                url: "{{ route('user.chart.data') }}",
                method: 'GET',
                data: {
                    nama_balita: nama_balita
                },
                success: function(response) {
                    if (heightChart) {
                        heightChart.destroy(); // Destroy the previous chart instance if exists
                    }
                    if (weightChart) {
                        weightChart.destroy(); // Destroy the previous chart instance if exists
                    }

                    var ctxHeight = document.getElementById('heightChart').getContext('2d');
                    var ctxWeight = document.getElementById('weightChart').getContext('2d');
                    var heightDatasets = [];
                    var weightDatasets = [];

                    for (var nama in response) {
                        heightDatasets.push({
                            label: nama,
                            data: response[nama].data,
                            fill: false,
                            borderColor: 'rgba(54, 162, 235, 1)',
                            tension: 0.1
                        });
                        weightDatasets.push({
                            label: nama,
                            data: response[nama].berat,
                            fill: false,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            tension: 0.1
                        });
                    }

                    heightChart = new Chart(ctxHeight, {
                        type: 'line',
                        data: {
                            labels: response[Object.keys(response)[0]].labels,
                            datasets: heightDatasets
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    weightChart = new Chart(ctxWeight, {
                        type: 'line',
                        data: {
                            labels: response[Object.keys(response)[0]].labels,
                            datasets: weightDatasets
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
        }

        // Initial Fetch without Filter
        fetchChartData();

        // Fetch Data on Filter Change
        $('#filterName').change(function() {
            var nama_balita = $(this).val();
            fetchChartData(nama_balita);
        });
    });


    
</script>
@endpush
