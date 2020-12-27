@extends('layouts.admin')
@section('judul','Tambah Keluarga')
@section('content')
@php
$kk_nums = 0;
$parent_id = null;
@endphp
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambah Keluarga <b>#{{ $kk_num->kk_num }}</b></h1>
            <br>
            
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Keluarga</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
      <button type="button" class="btn btn-primary mb-1" data-toggle="modal" data-target="#exampleModal">
      <i class="fas fa-plus"></i> Tambah
       </button>
      @if($msg = session('success'))
      <div class="alert alert-success" role="alert">
         {{ $msg }}
        </div>
        @elseif($msg = session('error'))
        <div class="alert alert-danger" role="alert">
            {{ $msg }}
        </div>
      @endif
      
      <div class="card p-2">


        <table class="table table-hover">
            <thead>
           
                <tr>
                    <th>No</th>
                    <th scope="col">Nomor NIK</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tempat Lahir</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Keterangan</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            
            <tbody id="tbody">
            
                @forelse($detail_kk as $num => $detail)
                @if($detail->position === "Suami" || $detail->position === "Wali")
                  @php 
                  $parent_id = \App\Models\Parents::where('kkdetail_id', $detail->id)->first()->id;
                  @endphp

                @endif
                    <tr>
                        <td>{{ $num+1 }}</td>
                        <td>{{ $detail->nik }}</td>
                        <td>{{ $detail->name }}</td>
                        <td>{{ $detail->place_of_birth }}</td>
                        <td>{{ $detail->dob }}</td>
                        <td>{{ $detail->position }}</td>
                        <td>
                        <form action="{{ route('orangtua.detail.destroy', $detail->id) }}" method="post">
                        @csrf
                        <button onclick="return confirm('Yakin hapus ?') " class="btn btn-danger">Hapus</button>
                        </form>/ <a href="#">Edit</a></td>
                    </tr>
                @empty
               <p>Tidak ada data sebelumnya</p>
                @endforelse
            </tbody>
            </table>
            {{ $detail_kk->links() }}

      </div>
      
    </div>
    
</div>


<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Keluarga</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="{{ route('orangtua.store') }}">
      @csrf
      <input type="hidden" name="kk_id" value="{{ $kk_num->id }}">
      <input type="hidden" value="{{$parent_id}}" name="parent_id">
        <div class="form-group">
            <label for="exampleInputEmail1">NIK</label>
            <input type="text" name="nik" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small id="error" style="color: red"></small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" name="password" value="123456" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <small>Password bawaan : 123456</small>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Nama</label>
            <input type="text" name="nama" class="form-control" id="exampleInputPassword1" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" id="exampleInputPassword1" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Tanggal Lahir</label>
            <input type="date" name="dob" class="form-control" id="exampleInputPassword1" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Jenis Kelamin</label>
            <select name="jk" class="form-control" id="">
                <option value="">Pilih</option>
                <option value="Laki-Laki">Laki-Laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Keterangan</label>
            <select name="keterangan" class="form-control" id="">
                <option value="">Pilih</option>
                <option value="Suami">Suami</option>
                <option value="Istri">Istri</option>
                <option value="Anak">Anak</option>
                <option value="Wali">Wali</option>
            </select>
            <div class="message">
            </div>
            <div class="jurusan"></div>
        </div>
        <button type="submit" id="submit_1" class="btn btn-primary">Submit</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





<script>
  $(document).ready( () => {
    $("select[name='keterangan']").on('change', () => {
      if($("select[name='keterangan']").val() === "Anak")
      {
        $(".message").append(`
        <span style="color: green;" id="message2">Akan otomatis di masukan ke dalam tabel pelajar</span>
      `)
      $(".jurusan").append(`
      <div class="form-group">
            <label for="exampleInputPassword1">Jurusan</label>
            <select name="jurusan" class="form-control" id="">
              <option>Pilih</option>
              @foreach($jurusan as $major)
                <option value="{{ $major->id }}">{{ $major->name }}</option>
              @endforeach
            </select>
        </div>
      `)
      }else{
        $("#message2").remove()
      }
    })

    var nik = $("input[name='nik']")
    
    $(nik).on('change', () => {
      $.ajax({
        url: "{{ route('api.nik.search') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          nik: nik.val()
        },
        success: (data) => {
          if(data == false)
          {
            $('#error').text(nik.val() + ' telah terdaftar !')
            $('#submit_1').attr('disabled','')
          }else{
            $('#error').text('')
            $('#submit_1').removeAttr('disabled','')

          }
        }
      })
    })

  })
</script>


@endsection