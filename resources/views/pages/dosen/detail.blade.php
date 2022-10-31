@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="font-bold text-3xl p-8">Detail Kelas</div>
    <div class="flex flex-row justify-center space-x-4">
        <form action="{{ route('dosen-kelas-absensi', $kelas->id) }}" method="GET" class="form-control">
            <button class="btn btn-info">Create Absensi</button>
        </form>

        <form action="{{ route('dosen-kelas-pengumuman', $kelas->id) }}" method="GET" class="form-control">
            <button class="btn btn-info">Create Pengumuman</button>
        </form>
    </div>
    <div class="font-bold text-xl ml-12">List Materi</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>Minggu Ke -</th>
                    <th>Materi</th>
                    <th>Deskripsi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listMateri as $materi)
                    <tr>
                        <td>{{ $materi->materi_minggu }}</td>
                        <td>{{ $materi->materi_judul }}</td>
                        <td>{{ $materi->materi_deskripsi }}</td>
                        <td>
                            <form action="{{ route('dosen-kelas-action-absensi', $kelas->id) }}" method="POST">
                                @csrf
                                <button name="edit" value="{{ $materi->id }}" class="btn btn-warning">Edit</button>
                                <button name="delete" value="{{ $materi->id }}" class="btn btn-error">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada materi saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="font-bold text-xl ml-12">List Pengumuman</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Deskripsi</th>
                    <th>Link</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listPengumuman as $key => $pengumuman)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $pengumuman->pengumuman_deskripsi }}</td>
                        <td>{{ $pengumuman->pengumuman_link }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Belum ada pengumuman saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
