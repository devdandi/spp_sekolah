@extends('layouts.admin')
@section('judul','Tambah kelas')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah kelas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah kelas</li>
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
        <div class="card-body">
        <form action="{{ route('kelas.store') }}" method="post">
        @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Tingkat kelas</label>
                <input type="text" name="tingkat_kelas" class="form-control @error('tingkat_kelas') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Kelas</label>
                <input type="text" name="nama_kelas" class="form-control @error('nama_kelas') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" >
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Jurusan</label>
                <select name="jurusan" class="form-control" id="">
                    <option value="pilih">Pilih</option>
                    @foreach($major as $majors)
                        <option value="{{ $majors->id}}">{{ $majors->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Max Siswa</label>
                <input type="text" name="max_siswa" class="form-control @error('max_siswa') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" >
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>

    

</div>
@endsection