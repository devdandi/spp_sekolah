@extends('layouts.frontend')
@section('title', 'Daftar Siswa Saya')
@section('content')
<div class="container valign">
    <div  class="card mt-1">
        <div class="card-body">
        <h3> Daftar Transaksi</h3>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Berhasil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Pending</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Gagal</a>
            </li>
            </ul>
                <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <ul class="list-group list-group-flush">
                        @forelse($success as $successed)
                        <li class="list-group-item">
                        <b><a href="#">#{{ $successed->order_id }}</a></b>
                        <div class="float-right">
                            <small>
                                <i>{{ date('Y/m/d', strtotime($successed->created_at)) }}</i>
                            </small>
                        </div>
                        <hr>

                        <h5>Subtotal: Rp. {{ number_format($successed->subtotal) }}</h5>

                    </li>
                    @empty
                    <p class="text-center">Tidak ada transaksi</p>
                        @endforelse
                    </ul>
                </div>
                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                @forelse($pending as $pendings)
                    <li class="list-group-item">
                        <b><a href="{{ route('user.payment.show', $pendings->snap_token) }}">#{{ $pendings->order_id }}</a></b>
                        <div class="float-right">
                            <small>
                                <i>{{ date('Y/m/d', strtotime($pendings->created_at)) }}</i>
                            </small>
                        </div>
                        <hr>
                        <h5>Subtotal: Rp. {{ number_format($pendings->subtotal) }}</h5>
                    </li>
                    @empty
                    <p class="text-center">Tidak ada transaksi</p>
                @endforelse
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                @forelse($failure as $failures)
                <li class="list-group-item">
                        <b><a href="#">#{{ $failures->order_id }}</a></b>
                        <div class="float-right">
                            <small>
                                <i>{{ date('Y/m/d', strtotime($failures->created_at)) }}</i>
                            </small>
                        </div>
                        <hr>
                        <h5>Subtotal: Rp. {{ number_format($failures->subtotal) }}</h5>
                    </li>
                    
                    @empty
                    <p class="text-center">Tidak ada transaksi</p>
                @endforelse
                </div>
            </div>
        </div>
    
    </div>
</div>

@endsection