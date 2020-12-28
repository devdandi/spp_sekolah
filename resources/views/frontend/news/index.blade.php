@extends('layouts.frontend')
@section('title', 'Sekolah KU DAN KAMU')
@section('content')
<div class="container valign">
    <div class="card mt-1">
        <div class="card-body">
            <h1>{{ $new->title }}</h1>
            <hr>
            <img src="{{ asset('storage/images') }}/{{$new->gambar}}" class="w-100" alt="">
            <small>{{ date('d/m/Y', strtotime($new->created_at)) }}</small>
            <p>{{ $new->pesan }}</p>

        </div>
    </div>
</div>
@endsection
