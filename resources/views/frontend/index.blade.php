@extends('layouts.frontend')
@section('title', 'Sekolah KU DAN KAMU')
@section('content')
<div class="container valign">
    <div class="card mt-1">
        <div class="card-header">
            Ringkasan
        </div>
        <div class="card-body text-center">
        @if($total > 0)
        <div class="alert alert-warning" role="alert">
            Tagihan bulan {{date('M Y')}}
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
                @foreach($new as $num => $news)
                <li class="list-group-item">
                <h5><a href="{{ route('pemberitahuan.index', $news->slug) }}">{{ $news->title }}</a></h5>
                        <div class="float-right">
                            <small>
                                <i>{{ date('Y/m/d', strtotime($news->created_at)) }}</i>
                            </small>
                        </div>
                        <hr>
                        <h5></h5>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
