@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="font-bold text-5xl p-10">Welcome, {{ Session::get('mahasiswa')['nama'] }}!</div>

    <div class="font-bold text-3xl text-center mb-4">List Kelas</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Periode</th>
                    <th>Dosen Pengajar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse (Session::get('listKelas') as $kelas)
                    @if ($kelas['jurusan'] == Session::get('mahasiswa')['jurusan'])
                        <tr>
                            <th>{{ $kelas['matakuliah'] }}</th>
                            <td>{{ $kelas['hari'] }}</td>
                            <td>{{ $kelas['jam'] }}</td>
                            <td>
                                @php
                                    $p = explode('-', $kelas['periode']);
                                    $p = $p[0] . '/' . $p[1];
                                @endphp
                                {{ $p }}
                            </td>
                            <td>{{ $kelas['dosen'] }}</td>
                            <td>
                                <form action="{{ route('mahasiswa-join-kelas') }}" method="POST">
                                    @csrf
                                    <button name="join" value="{{ $kelas['id'] }}" class="btn btn-info w-2/3">Join</button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @empty
                    <tr>
                        <td colspan="6" class="text-center font-bold">Tidak ada kelas saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
