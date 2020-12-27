@extends('layouts.admin')
@section('judul','Tambah Siswa')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Siswa</h1>
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
            <div class="container-fluid">
            <form method="post" action="{{ route('orangtua.store') }}">
            @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">NISN</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nisn" placeholder="Masukan NISN">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" placeholder="Masukan nama">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Tanggal Lahir</label>
                <input type="date" class="form-control" id="exampleInputEmail1" style="width: 150px;" aria-describedby="emailHelp" name="tanggallahir" placeholder="Masukan nama">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Identitas Orang Tua</label>
                <br>
                <div class="card alert alert-secondary">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-3">
                        <p><b>Nama: {{ $parent_base->name }} </b></p>
                      </div>
                      <div class="col-md-3">
                        <p><b>Email: {{ $parent_base->email }} </b></p>
                      </div>
                      <div class="col-md-3">
                        <p><b>Level Akun: {{ \App\Models\Level::find($parent_base->level_id)->keterangan }} </b></p>
                      </div>
                      <div class="col-md-3">
                        <p><b>Status: @if($parent_base->status === 1) Aktif @else <span style="color: red;">Tidak Aktif / Lulus</span> @endif </b></p>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Jurusan</label>
                <select class="form-control" style="width:300px;" name="jurusan">
                  <option value="">Pilih</option>
                  @foreach($major as $m)
                    <option value="{{ $m->id }}">{{ $m->name }}</option>
                  @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Kelas</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="nama" placeholder="Masukan nama">
            </div>
           

            <div class="form-group">
                <label for="exampleInputEmail1">Alamat Email</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Masukan Email">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Hak Akses</label>
                <select name="level" id="" class="form-control">
                    <option value="Pilih">Pilih</option>
                   
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