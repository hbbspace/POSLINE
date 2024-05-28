@extends('user.layouts.template')

@section('content')
    <div class="container">
        <div class="card card-info">
            <div class="card-header">
                Dashboard
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
                            <p>{{$jumlahAnak}} Jumlah Balita Anda Yang Terdaftar</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-trophy"></i>
                          </div>
                          <a href="{{url('/user/dataBalitaUser')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                      <div class="col-lg-6 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                          <div class="inner">
                            <h3>Total Pemeriksaan</h3>
                            <p>{{$hasil_pemeriksaan}} Pemeriksaan telah dilakukan</p>
                          </div>
                          <div class="icon">
                            <i class="ion ion-trophy"></i>
                          </div>
                          <a href="{{url('/user/dataPemeriksaanBalita')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                      </div>
                        <a href="{{ route('logout') }}">Logout</a>

                  
            </div>
        </div>
        <section class="content">
            
            </div>
        </section>
    </div>
@endsection
