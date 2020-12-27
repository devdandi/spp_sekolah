@extends('layouts.admin')
@section('judul','Tambah Siswa')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Siswa</li>
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
            <div class="container-fluid">
            <form method="post" action="{{ route('siswa.edit.proses', $siswa->id) }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">NISN</label>
                <input type="text" class="form-control" value="{{ $siswa->nisn }}" id="exampleInputEmail1" aria-describedby="emailHelp" name="nisn" placeholder="Masukan NISN">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" value="{{ $siswa->kkdetail->name }}" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" placeholder="Masukan nama">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Lahir</label>
                <input type="date" class="form-control" value="{{ $siswa->kkdetail->dob }}" id="exampleInputEmail1" style="width: 200px;" aria-describedby="emailHelp" name="tanggallahir" placeholder="Masukan nama">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Jurusan</label>
                <select class="form-control" style="width:300px;" name="major">
                  <option value="{{ $siswa->major->id }}">{{ $siswa->major->name }}</option>
                  <option value="">-----------------------------------------------------</option>
                  @foreach($major as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                  @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Kelas</label>
                <select name="kelas" id="" class="form-control">
                @if($siswa->class_id === null)
                  <option value="Pilih">Pilih</option>
                  @else
                  <option value="{{ $siswa->class_id }}">{{ $siswa->class->classes }} {{ $siswa->class->name }}</option>
                  <option value="">-----------------------------------------------------</option>

                @endif
                    @foreach($kelas as $k)
                        <option value="{{ $k->id }}">{{ $k->classes }} {{ $k->name }}</option>
                    @endforeach
                </select>
            </div>
           

            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Email</label>
                <input type="text" value="{{ $siswa->email }}" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Masukan Email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Hak Akses</label>
                <select name="level" id="" class="form-control">
                    <option value="{{ $siswa->level_id }}">{{ $siswa->level->keterangan }}</option>
                    @foreach($level as $l)
                        <option value="{{ $l->id }}">{{ $l->keterangan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <p>Otomatis terkirim ke email <span style="color: green;" class="email"></span></p>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
            </div>
        </div>
    </div>

    

</div>
@endsection