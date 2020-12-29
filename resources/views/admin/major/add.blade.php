@extends('layouts.admin')
@section('judul','Tambah Jurusan')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Jurusan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Jurusan</li>
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
        <form action="{{ route('jurusan.store') }}" method="post">
        @csrf
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Jurusan</label>
                <input type="text" name="name" class="form-control @error('title') is-invalid @enderror" id="exampleInputEmail1" aria-describedby="emailHelp" >
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
      </div>
    </div>

    

</div>
@endsection