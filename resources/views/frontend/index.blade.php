@extends('layouts.frontend')
@section('title', 'Sekolah KU DAN KAMU')
@section('content')
@if(isset($_GET['page']))
    @if($_GET['page'] == 0)
        <script>window.location.href="{{ route('user.index') }}"</script>
    @endif
@endif
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
                @foreach($new as $num => $news)
                <div class="media">
                <a href="{{ route('pemberitahuan.index', $news->slug) }}"><img class="align-self-start mr-3" src="{{ asset('storage/images') }}/{{$news->gambar}}" width="64" height="64" alt="Generic placeholder image"></a>
                    <div class="media-body">
                        <h5 class="mt-0"><a class="text-blue" href="{{ route('pemberitahuan.index', $news->slug) }}">{{ $news->title }}</a></h5>
                        <small class="text-blue">Tanggal: {{ date('d/m/Y', strtotime($news->created_at)) }}</small>
                    </div>
                </div>
                <hr>
            @endforeach
            <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item">
            <a class="page-link" href="?page={{$new->currentPage()-1}}" tabindex="-1">Kembali</a>
            </li>
            <li class="page-item">
            <a class="page-link" href="{{ $new->nextPageUrl() }}">Selanjutnya</a>
            </li>
        </ul>
    </nav>
        </div>
    </div>

    
</div>

@endsection