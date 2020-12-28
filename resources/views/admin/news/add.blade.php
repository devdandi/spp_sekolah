@extends('layouts.admin')
@section('judul','Tambah Pemberitahuan')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Pemberitahuan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pemberitahuan</li>
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
        <form action="{{ route('news.create') }}" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Judul</label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" >
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Isi pesan</label>
                <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror" id="" cols="30" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Gambar ( <small><i style="color: red">Tidak wajib</i></small> )</label><br/>
                <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">
                @error('gambar') <small style="color: red;">Ektensi hanya JPG, PNG</small> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>

    

</div>
@endsection