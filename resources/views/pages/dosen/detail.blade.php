@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="font-bold text-3xl p-8">Detail Kelas</div>
    <div class="flex flex-col items-center">
        <form action="{{ route('dosen-kelas-absensi', $detail['id']) }}" method="GET">
            <button class="btn btn-info">Create Absensi</button>
        </form>
    </div>
    <div class="font-bold text-xl ml-12">List Absensi</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>Minggu Ke -</th>
                    <th>Materi</th>
                    <th>Deskripsi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detail['absensi'] as $absen)
                    <tr>
                        <td>{{ $absen['minggu'] }}</td>
                        <td>{{ $absen['materi'] }}</td>
                        <td>{{ $absen['deskripsi'] }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada absensi saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="font-bold text-xl ml-12">List Mahasiswa</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NRP</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($detail['mahasiswa'] as $key=>$mahasiswa)
                    @foreach (Session::get('listUser') as $user)
                        @if ($user['username'] == $mahasiswa)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $mahasiswa }}</td>
                                <td>{{ $user['nama'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                @empty
                    <tr>
                        <td colspan="3">Belum ada mahasiswa saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
