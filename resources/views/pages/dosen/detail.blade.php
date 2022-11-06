@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Detail Kelas</div>
    </div>
    <div class="flex flex-row justify-center space-x-4">
        <form action="{{ route('dosen-kelas-module', $id) }}" method="GET" class="form-control">
            <button class="btn btn-info">Create Module</button>
        </form>

        <form action="{{ route('dosen-kelas-absensi', $id) }}" method="GET" class="form-control">
            <button class="btn btn-info">Create Absensi</button>
        </form>

        <form action="{{ route('dosen-kelas-pengumuman', $id) }}" method="GET" class="form-control">
            <button class="btn btn-info">Create Pengumuman</button>
        </form>
    </div>
    <div class="font-bold text-xl ml-12">List Module</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis</th>
                    <th>Nama</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listModule as $key => $m)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $m->module_jenis }}</td>
                        <td>{{ $m->module_nama }}</td>
                        <td>{{ $m->module_deadline }}</td>
                        <td>
                            @if ($m->module_status == 1)
                                Aktif
                            @else
                                Tidak Aktif
                            @endif
                        </td>
                        <td>
                            @php
                                $module = $m->id;
                            @endphp
                            <form action="{{ route('dosen-kelas-action-module', [$id, $module]) }}" method="POST">
                                @csrf
                                <button name="detail" value="{{ $m->id }}" class="btn btn-warning">Detail</button>
                                @if ($m->module_status == 1)
                                    <button name="selesai" value="{{ $m->id }}"
                                        class="btn btn-error">Selesaikan</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada module saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
                            <form action="{{ route('dosen-kelas-action-absensi', $id) }}" method="POST">
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
