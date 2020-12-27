@extends('layouts.admin')
@section('judul','Laporan Keuangan')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Laporan Keuangan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Laporan Keuangan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p><a href=""><i class="fas fa-file-download"></i> Download Excel</a></p>
                        <h1>Keuangan Bulanan </h1>
                        <hr>
                        <h3 id="monthly"></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p><a class="" href=""><i class="fas fa-file-download"></i> Download Excel</a></p>
                        <h1>Tunggakan Bulanan</h1>
                        <hr>
                        <h3 id="monthly_tunggakan"></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(() => {
        
        $.ajax({
            url: "{{ route('api.report.money.monthly') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: (data) => {
                // console.log(data)
                $("#monthly").text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data) + " ( {{ date('M') }} )")
            },
            beforeSend: () => {
                $("#monthly").text("Menghitung keuangan bulan {{ date('M') }}")
            }
        })

        $.ajax({
            url: "{{ route('api.report.money.monthly.tunggakan') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: (data) => {
                // console.log(data)
                $("#monthly_tunggakan").text(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data) + " ( {{ date('M') }} )")
            },
            beforeSend: () => {
                $("#monthly_tunggakan").text("Menghitung tunggakan bulan {{ date('M') }}")
            }
        })
    })
</script>
@endsection