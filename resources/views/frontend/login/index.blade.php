@extends('layouts.frontend')
@section('title', 'Masuk')
@section('content')
<div class="container valign">
    <div class="card mt-3">
        <div class="card-body">
        @if($msg = session('success'))
      <div class="alert alert-success" role="alert">
         {{ $msg }}
        </div>
        @elseif($msg = session('error'))
        <div class="alert alert-danger" role="alert">
            {{ $msg }}
        </div>
      @endif
        <form method="post" action="{{ route('user.login') }}"> 
            @csrf 
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Kata sandi">  
            </div>
            <button type="submit" class="btn btn-primary">Masuk</button>
            </form>
            <p><small><i><small>Kata sandi di kirim ke email saat melakukan pendaftaran siswa</small></i></small></p>
        </div>
    </div>
</div>
@endsection