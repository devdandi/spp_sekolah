@extends('layouts.admin')
@section('judul','Halaman Utama')
@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3 id="pembayaran">0</h3>

                <p>Pembayaran</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="{{ route('laporan.filter') }}" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3 id="tunggakan">0</h3>

                <p>Tunggakan</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="{{ route('laporan.filter') }}" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3 id="siswa">0</h3>

                <p>Siswa</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{ route('siswa.index') }}" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3 id="payment_failed">0</h3>

                <p>Pembayaran Gagal</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="{{ route('laporan.filter') }}" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>

                <p>Jumlah Guru</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
<!-- 
          <div class="col-lg-3 col-6">

            <div class="small-box bg-danger">
              <div class="inner">
                <h3>0</h3>

                <p>Pesan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Lihat semua <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> -->
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">


          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <script>
          $.ajax({
            url: "{{ route('api.tunggakan.count') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: (data) => {
                $("#tunggakan").text(data)
            },
            beforeSend: () => {
                $("#tunggakan").text("Tunggu")
            }
        })
        
        $.ajax({
            url: "{{ route('api.pembayaran.count') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: (data) => {
                // console.log(data)
                $("#pembayaran").text(data)
            },
            beforeSend: () => {
                $("#pembayaran").text("Loading")
            }
        })

        $.ajax({
            url: "{{ route('api.siswa.count') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: (data) => {
                // console.log(data)
                $("#siswa").text(data)
            },
            beforeSend: () => {
                $("#siswa").text("Loading")
            }

            
        })

        $.ajax({
            url: "{{ route('api.payment.failure.count') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: (data) => {
                // console.log(data)
                $("#payment_failed").text(data)
            },
            beforeSend: () => {
                $("#payment_failed").text("Loading")
            }
        })
  </script>
@endsection