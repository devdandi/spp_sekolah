@extends('layouts.admin')
@section('judul','Daftar Jurusan')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Jurusan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Jurusan</li>
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
                        <th scope="col">Nama Jurusan</th>
                        <th>Tanggal buat</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                   @forelse($major as $num => $majors)
                   <tr>
                   <td>{{ $num+1 }}</td>
                    <td>{{ $majors->name }}</td>
                    <td>{{ $majors->created_at }}</td>
                    <td><form action="{{ route('jurusan.delete', $majors->id) }}" method="post">@csrf <button class="btn btn-danger" onclick="return confirm('Yakin di hapus ? ')">Hapus</button></form></td>
                   </tr>
                   @empty
                    <p>Tidak ada data</p>
                   @endforelse
                </tbody>
            </table>
            {{ $major->links()}}
        </div>
    </div>
</div>
@endsection