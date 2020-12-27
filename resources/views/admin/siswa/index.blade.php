@extends('layouts.admin')
@section('judul','Daftar Siswa')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Daftar Siswa</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Siswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
        <div class="card">
            <table class="table ">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Status</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Kelas</th>
                        <th scope="col">Orang Tua</th>
                    </tr> 
                    </thead>
                    <tbody>
                    @foreach($siswa as $num => $student)

                      <tr>
                        <td>{{ $num+1 }}</td>
                        @if($student->nisn === null)
                          <td>Belum terdaftar</td>
                          @else
                          <td>{{ $student->nisn }}</td>
                        @endif
                        <td>{{ $student->kkdetail->name }}</td>
                        @if($student->status === 1)
                          <td><span style="background-color: green; padding: 3px; color: white; border-radius: 5px 5px 5px;">Aktif</span></td>
                        @else
                          <td><span style="background-color: red; padding: 3px; color: white; border-radius: 5px 5px 5px;">Tidak aktif</span></td>
                        @endif
                          <td>{{ $student->major->name }}</td>
                        @if($student->class_id === null)
                          <td>Belum terdaftar</td>
                          @else
                          <td>{{ $student->class->classes . ' ' . $student->class->name}}</td>
                        @endif
                        <td>{{ \App\Models\DetailKK::where('kk_id', $student->kk_id)->where('position','Suami')->first()->name }}</td>
                        <td><a href="{{ route('siswa.edit', $student->id) }}">Edit</a></td>
                      </tr>
                    @endforeach
            
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection