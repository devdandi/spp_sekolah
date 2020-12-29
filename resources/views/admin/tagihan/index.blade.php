@extends('layouts.admin')
@section('judul','Tagihan SPP')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tagihan SPP</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tagihan SPP</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      @if($msg = session('success'))
      <div class="alert alert-success" role="alert">
         {{ $msg }}
        </div>
        @elseif($msg = session('error'))
        <div class="alert alert-danger" role="alert">
            {{ $msg }}
        </div>
      @endif
        <div class="card">
    
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Siswa</th>
                        <th>Kelas</th>
                        <th scope="col">Orang Tua</th>
                        <th scope="col">SPP Bulan</th>
                        <th>Total</th>
                        <th>Tanggal Keluar</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total = 0; @endphp
                    @foreach($parent->tunggakan->where('status','no_paid') as $num => $tunggakan)
                        <tr>
                            @php $total += $tunggakan->total @endphp
                            <td>{{ $num+1 }}</td>
                            <td>{{ $tunggakan->getNameStudent($tunggakan->student_id) }}</td>
                            <td>{{ $tunggakan->getClassStudent($tunggakan->class_id) }}</td>
                            <td>{{ $parent->kkdetail->name }}</td>
                            <td>{{ date('M Y', strtotime($tunggakan->created_at)) }}</td>
                            <td>Rp. {{ number_format($tunggakan->total) }}</td>
                            <td>{{ date('d M Y', strtotime($tunggakan->created_at)) }}</td>
                            <td>
                                <form action="{{ route('tagihan.show', $tunggakan->id) }}" method="post">
                                    @csrf 
                                    <button onclick="return confirm('Lanjutkan pembayaran ? ')"  data-toggle="modals" data-target="#exampleModal1" class="btn btn-danger">Bayar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h4>Total: Rp. {{ number_format($total) }}</h4>
          
        @if($parent->tunggakan->count() < 1)
          @else
          <form method="post" action="{{ route('tagihan.show.all', $parent->id) }}">
          @csrf 
          <button onclick="return confirm('Lanjutkan pelunasan ?') " class="btn btn-success">Bayar Semua</button>
        </form>  
        @endif
    </div>
</div>
@endsection