@extends('layouts.admin')
@section('judul','Daftar Kelas')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Kelas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daftar Kelas</li>
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
                        <th scope="col">Tingkat Kelas</th>
                        <th>Nama Kelas</th>
                        <th>Nama Jurusan</th>
                        <th>Jumlah Maksimum</th>
                        <th>Jumlah Siswa</th>
                        <th>Tanggal buat</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                   @forelse($class as $num => $classes)
                    <tr>
                        <td>{{ $num+1 }}</td>
                        <td>{{ $classes->classes }}</td>
                        <td>{{ $classes->name }}</td>
                        <td>{{ $classes->getMajorName($classes->major_id) }}</td>
                        <td>{{ $classes->full }}</td>
                        <td>{{ $classes->student->count() }}</td>
                        <td>{{ $classes->created_at }}</td>
                        <td><form action="{{ route('kelas.delete', $classes->id ) }}">@csrf <button class="btn btn-danger" onclick="return confirm('Yakin hapus? ')">Hapus</button></form></td>
                    </tr>
                   @empty
                    <p>Tidak ada data</p>
                   @endforelse
                </tbody>
            </table>
            {{ $class->links()}}
        </div>
    </div>
</div>
@endsection