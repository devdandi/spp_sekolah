@extends('layouts.frontend')
@section('title', 'Daftar Siswa Saya')
@section('content')
<div class="container valign">
    <div  class="card mt-1">
        <div class="card-body">
        <h4>Daftar Tagihan</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th>SPP Bulan</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Pilih</th>
                    </tr>
            </thead>
        <tbody>
            @foreach($tagihan as $num => $tagihans)
            @csrf
                <form action="{{ route('user.payment') }}" method="post">
                    <tr>
                        <td>{{ $num+1 }}</td>
                        <td>{{ $tagihans->getNameStudent($tagihans->student_id) }}</td>
                        <td>{{ date('M Y', strtotime($tagihans->created_at)) }}</td>
                        <td>Rp.{{ number_format($tagihans->total) }}</td>
                        @if($tagihans->status === "paid")
                            <td>LUNAS</td>
                        @else 
                        <td>BELUM LUNAS</td>
                        @endif
                        <td>
                        <div class="form-check">
                            <input type="checkbox" value="{{ $tagihans->id }}" name="checkbox[]" class="form-check-input" id="exampleCheck1">
                        </div>
                    </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
            <button class="btn btn-info" >Bayar Semua</button> / 
            <a href="{{ route('user.index') }}">Kembali</a>
            </form>

        </div>
    </div>
</div>

@endsection