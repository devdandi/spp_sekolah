@extends('layouts.frontend')
@section('title', 'Pembayaran Berhasil')
@section('content')
<div class="container valign">
    <div class="card mt-1 p-2">
        <div class="card-body">
            <h3>Status Pembayaran </h3>
            <div class="d-flex justify-content-center">
                <img src="{{ asset('image/icon/success.png') }}"  style="width: 50%;" alt="">
            </div>
            <h5 class="text-center">Pembayaran Berhasil</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">ID Pembayaran: <b>#{{ $detail->order_id }}</b></li>
                <li class="list-group-item">Jumlah pembayaran : {{ count(json_decode($detail->tunggakan_id)) }}x</li>
                <li class="list-group-item">Subtotal : Rp. {{ number_format($detail->subtotal) }}</li>
            </ul>
        </div>
        <a href="{{ route('user.index')}}">Kembali</a>
    </div>
    
</div>

@endsection
