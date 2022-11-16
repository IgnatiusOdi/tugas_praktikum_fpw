@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="text-3xl font-bold text-center">Hasil Pencarian</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Role</th>
                    <th>Nama</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $jumlahDosen = 0;
                @endphp
                @forelse ($listDosen as $key => $dosen)
                    <tr>
                        @php
                            $jumlahDosen++;
                        @endphp
                        <td>{{ $key + 1 }}</td>
                        <td>DOSEN</td>
                        <td>{{ $dosen->dosen_nama }}</td>
                        <td>
                            <form action="{{ route('mahasiswa-find-dosen', $dosen->id) }}" method="get">
                                <button class="btn btn-info">Detail</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Pencarian dosen tidak ditemukan!</td>
                    </tr>
                @endforelse
                @forelse ($listMahasiswa as $key => $mahasiswa)
                    <tr>
                        <td>{{ $jumlahDosen + $key + 1 }}</td>
                        <td>MAHASISWA</td>
                        <td>{{ $mahasiswa->mahasiswa_nama }}</td>
                        <td>
                            <form action="{{ route('mahasiswa-find-teman', $mahasiswa->id) }}" method="get">
                                <button class="btn btn-info">Detail</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Pencarian mahasiswa tidak ditemukan!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
