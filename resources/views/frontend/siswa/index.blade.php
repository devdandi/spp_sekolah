@extends('layouts.frontend')
@section('title', 'Daftar Siswa Saya')
@section('content')
<div class="container valign">
    <div class="card mt-1">
        <div class="card-body">
        <h4>Daftar Murid Saya</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NISN</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Kelas</th>
                    </tr>
            </thead>
        <tbody>
            @foreach($student as $num => $students)
                <tr>
                    <td>{{ $num+1 }}</td>
                    <td>{{ $students->nisn }}</td>
                    <td>{{ $students->kkdetail->name }}</td>
                    <td>{{ $students->major->name }}</td>
                    @if($students->class_id === null)
                        <td>Belum terdaftar</td>
                    @else
                    <td>{{ $students->class->classes }} {{ $students->class->name }}</td>
                    @endif
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $student->links() }}
            <a href="{{ route('user.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection