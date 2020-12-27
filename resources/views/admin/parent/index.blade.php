@extends('layouts.admin')
@section('judul','Daftar Orang Tua')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Orang Tua</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orang Tua</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
        <div class="card">
    
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Status</th>
                        <th scope="col">Anak</th>
                        <th>Tagihan ( SPP )</th>
                        <th>Keterangan</th>
                        <th>Opsi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orangtua as $num => $parent)
                        <tr>
                          @if($parent->kkdetail->position === "Suami")
                            <td>{{ $num+1 }}</td>
                            <td>{{ $parent->kkdetail->name }}</td>
                            <td>{{ $parent->email }}</td>
                            @if($parent->status === 1)
                                <td style="color: green">Aktif</td>
                            @else
                                <td style="color: red">Tidak Aktif/Lulus</td>
                            @endif
                            <td>{{ $parent->student->count() }}</td>
                            <td><a href="{{ route('tagihan.index', $parent->id) }}">{{\App\Models\Tunggakan::where('parent_id', $parent->id)->where('status','no_paid')->count() }} Bulan</a></td>   
                            <td>{{ strtoupper($parent->kkdetail->position) }}</td>
                            <td><a onclick="return confirm('Lanjutkan ?')" href="#">Edit</a></td>
                            @endif
                        </tr>
                    @endforeach
                    {{ $orangtua->links() }}
                </tbody>
            </table>
        </div>
    </div>

    

</div>
@endsection