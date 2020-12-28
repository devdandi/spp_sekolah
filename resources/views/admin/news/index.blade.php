@extends('layouts.admin')
@section('judul','Daftar Pemberitahuan')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Pemberitahuan</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pemberitahuan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      @if($msg = session('success'))
      <div class="alert alert-success" role="alert">
         {{ $msg }}
        </div>
        @elseif($msg = session('error'))
        <div class="alert alert-danger" role="alert">
            {{ $msg }}
        </div>
      @endif
      <div class="card">
      <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Judul</th>
                        <!-- <th scope="col">Gambar</th> -->
                        <th scope="col">Tanggal</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($new as $num => $news)
                      <tr>
                        <td>{{ $num+1 }}</td>
                        <td>{{ \App\Models\User::find($news->user_id)->name }}</td>
                        <td>{{ $news->title }}</td>
                        <!-- <td><img width="50" src="{{ asset('storage/images') }}/{{$news->gambar}}" alt=""></td> -->
                        <td>{{ date('d/m/Y', strtotime($news->created_at)) }} </td>
                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$news->id}}">
                          Detail
                        </button> / <form action="{{ route('news.destroy', $news->id) }}" method="post">@csrf <button onclick="return confirm('Hapus ?') }}" class="btn btn-danger">Hapus</button></form></td>
                      </tr>

                      <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{$news->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img src="{{ asset('storage/images') }}/{{ $news->gambar}}" width="450" alt="">
                            <hr>
                            <p>{{ $news->pesan }}</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
            {{ $new->links() }}
      </div>
    </div>

    

</div>
@endsection