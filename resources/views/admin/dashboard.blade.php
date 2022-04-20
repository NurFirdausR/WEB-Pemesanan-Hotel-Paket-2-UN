@extends('layouts.master_admin')
@section('content')

<div class="main-content">
    <section class="section">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
              <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Tipe Kamar</h4>
              </div>
              <div class="card-body">
                {{$total_tipe_kamar}}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
              <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Kamar</h4>
              </div>
              <div class="card-body">
                {{$total_kamar}}

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
              <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Fasilitas Umum</h4>
              </div>
              <div class="card-body">
                {{$total_fasilitas_umum}}

              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Fasilitas Kamar</h4>
              </div>
              <div class="card-body">
                {{$total_fasilitas_kamar}}

              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 justi">
          <div class="card card-statistic-1">
            <div class="card-icon bg-success">
              <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Jumlah Pendapatan</h4>
              </div>
              <div class="card-body">
                Rp
                {{$total_pendapatan}}

              </div>
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>
 
</div>

@endsection