@extends('layouts.admin')
@section('judul','Tabel Pembayaran')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tabel Pembayaran</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tabel Pembayaran</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      
        <!-- <form action="{{ route('laporan.filter.text') }}" method="post">
        @csrf
        <div class="d-flex flex-row">
          <div class="p-2">
            <span>Cari</span>
            <input type="text" class="form-control" name="q" placehoder="">
          </div>
          <div class="p-2 mt-4">
            <input type="submit" class="form-control" name="submit">
          </div>
        </div>
        </form> -->

        <form action="{{ route('laporan.filter.tanggal') }}" method="post">
        @csrf
        <div class="d-flex flex-row">
          <div class="p-2">
          Filter
            <select name="filter" class="form-control mb-1" id="">
              <option value="">Filter status</option>
              <option value="paid">Lunas</option>
              <option value="no_paid">Belum Lunas</option>
          </select>
          </div>
          <div class="p-2">
          <span>Dari Tanggal</span>
            <input type="date" class="form-control" name="dari">
          </div>
          <div class="p-2">
            <span>Sampai Tanggal</span>
            <input type="date" class="form-control" name="sampai">
          </div>
          <div class="p-2 mt-4">
            <input type="submit" class="form-control" name="submit">
          </div>
        </div>
        </form>
        
        <div class="card">
          
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email Orang Tua</th>
                        <th>Email Siswa</th>
                        <th scope="col">Nama Orang Tua</th>
                        <th>Jurusan</th>
                        <th scope="col">Kelas</th>
                        <th>Tagihan Bulan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tagihan Keluar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tunggakan as $num => $tunggakans)
                        <tr>
                            <td>{{ $num+1 }}</td>
                            <td>{{ $tunggakans->getNameStudent($tunggakans->student_id) }}</td>
                            <td>{{ $tunggakans->getEmailParent($tunggakans->parent_id) }}</td>
                            <td>{{ $tunggakans->getEmailStudent($tunggakans->student_id) }}</td>
                            <td>{{ $tunggakans->getNameParent($tunggakans->parent_id) }}</td>
                            <td>{{ $tunggakans->getMajorName($tunggakans->class_id) }}</td>
                            <td>{{ $tunggakans->getClassStudent($tunggakans->class_id) }}</td>
                            <td>{{ date('M Y', strtotime($tunggakans->created_at)) }}</td>
                            <td>Rp. {{ number_format($tunggakans->total) }}</td>
                            @if($tunggakans->status === "paid")
                              <td style="color: green">LUNAS</td>
                            @else
                              <td  style="color: red">BELUM LUNAS</td>
                            @endif
                            <td>{{ date('d/m/Y', strtotime($tunggakans->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $tunggakan->links() }}
        </div>
    </div>
</div>
<script>
  $(document).ready( () => {
    var filter = $("select[name='filter']")
    $(filter).on('change', () => {
     if(filter.val() == 'no_paid')
     {
       window.location.href="{{ route('laporan.filter') }}?status=belum-lunas"
       
     }else{
      window.location.href="{{ route('laporan.filter') }}?status=lunas"

     } 
    })
   
  })
</script>
@endsection