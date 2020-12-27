@extends('layouts.frontend')
@section('title', 'Sekolah KU DAN KAMU')
@section('content')
<div class="container valign">
    <div class="card mt-1 p-2">
        <div class="card-body">
        <h3>Detail pembayaran </h3>

            <ul class="list-group list-group-flush">

                <li class="list-group-item">ID Pembayaran: <b>#{{ $detail->order_id }}</b></li>
                <li class="list-group-item">Jumlah pembayaran : {{ count(json_decode($detail->tunggakan_id)) }}x</li>

                <li class="list-group-item">Subtotal : Rp. {{ number_format($detail->subtotal) }}</li>
                <li class="list-group-item">Status: @if($detail->status === "waiting_payment") Menunggu pembayaran @endif</li>
            </ul>
        </div>
        <button id="pay-button" class="btn bg-blue text-white p-2">Pilih Pembayaran</button>
        

    </div>
    
</div>
<script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      // For example trigger on button clicked, or any time you need
      payButton.addEventListener('click', function () {
          
        snap.pay('{{ $detail->snap_token }}'); // Replace it with your transaction token
      });
    </script>
@endsection
