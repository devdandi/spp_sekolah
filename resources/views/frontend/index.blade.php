@extends('layouts.frontend')
@section('title', 'Sekolah KU DAN KAMU')
@section('content')
<div class="container valign">
    <div class="card mt-1">
        <div class="card-header">
            Ringkasan <form action="{{ route('user.logout') }}" method="post">@csrf <button onclick="return confirm('Keluar ? ') " class="btn btn-danger">Keluar</button></form>
        </div>
        <div class="card-body text-center">
        @if($total > 0)
        <div class="alert alert-warning" role="alert">
            Tagihan bulan ini telah keluar
        </div>
        @else
        <div class="alert alert-success" role="alert">
            Tidak ada tagihan
        </div>
        @endif
        
           <div class="row">
               <div class="col-6">
                   <div class="card-none">
                       <span>Murid saya</span>
                       <hr>
                       <small>1</small><br/>
                       <small><a href="{{ route('user.siswa')}}">Lihat</a></small>
                   </div>
               </div>
               <div class="col-6">
                   <div class="card-none">
                       <span>Tagihan saya</span>
                       <hr>
                       <small>Rp. {{ number_format($total)}}</small><br/>
                       <small><a href="{{ route('user.tagihan') }}">Lihat</a></small>
                   </div>
               </div>
               <hr>
           </div>
           
        </div>
    </div>

    <small><b>Pemberitahuan</b></small>
    <div class="card mt-1">
        <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item">Cras justo odio</li>
            <li class="list-group-item">Dapibus ac facilisis in</li>
            <li class="list-group-item">Morbi leo risus</li>
            <li class="list-group-item">Porta ac consectetur ac</li>
            <li class="list-group-item">Vestibulum at eros</li>
        </ul>
        </div>
    </div>
</div>
@endsection
