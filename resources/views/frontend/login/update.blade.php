@extends('layouts.frontend')
@section('title', 'Perbarui')
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
        <form method="post" action="{{ route('user.update') }}"> 
            @csrf 
            <div class="form-group">
                <label for="">Nomor KK</label>
                <input type="text" readonly class="form-control" name="email" value="{{ $user->kk->kk_num }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="">NIK</label>
                <input type="text" readonly class="form-control" name="email" value="{{ $user->kkdetail->nik }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" readonly class="form-control" name="email" value="{{ $user->kkdetail->name }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
            <label for="">Email</label>

                <input type="email" readonly class="form-control" name="email" value="{{ $user->email }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email">
            </div>
            <div class="form-group">
            <label for="">Password</label>

                <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Kata sandi">  
            </div>
            <button type="submit" class="btn btn-primary">Perbarui</button>
            </form>
        </div>
    </div>
</div>
@endsection