@extends('layouts.admin')
@section('judul','Daftar Siswa')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
        <div class="card">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Jam Transaksi</th>
                        <th scope="col">Status Transaksi</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Pesan</th>
                        <th scope="col">Tipe Pembayaran</th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Total</th>
                        <th>Fraud Status</th>
                        <th>Tanggal</th>
                    </tr> 
                    </thead>
                    <tbody>
                    @foreach($callback as $num => $callbacks)
                    
                    @endforeach
            
                </tbody>
            </table>
            {{ $siswa->links() }}
            <p><small>Jika siswa belum terdaftar kelas atau nisn maka status tidak aktif dan tagihan spp tidak akan keluar</small></p>

        </div>
    </div>
</div>
@endsection