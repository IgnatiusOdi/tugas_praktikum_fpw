@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="font-bold text-3xl p-8">Detail Kelas</div>
    <div class="ml-6">
        <div>Mata Kuliah : {{ $kelas->matakuliah->matakuliah_nama }}</div>
        <div>Hari : {{ $kelas->hari->hari_nama }}</div>
        <div>Jam : {{ $kelas->jam->jam_nama }}</div>
        <div>Periode : {{ $kelas->periode->periode_tahun }}</div>
        <div>Dosen : {{ $kelas->dosen->dosen_nama }}</div>

    </div>
    <div class="font-bold text-3xl p-8">Absensi</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>Minggu Ke -</th>
                    <th>Materi</th>
                    <th>Deskripsi</th>
                    <th>Keterangan Kehadiran Mahasiswa</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kelas->materi as $materi)
                    <tr>
                        @php
                            $kehadiran = false;
                        @endphp
                        <td>{{ $materi->materi_minggu }}</td>
                        <td>{{ $materi->materi_judul }}</td>
                        <td>{{ $materi->materi_deskripsi }}</td>
                        @foreach ($listAbsensi as $absen)
                            @if ($absen->materi_id == $materi->id)
                                @if ($absen->absensi_status == 1)
                                    <td>V</td>
                                @else
                                    <td>X</td>
                                @endif
                                @php
                                    $kehadiran = true;
                                    break;
                                @endphp
                            @endif
                        @endforeach
                        @if (!$kehadiran)
                            <td>X</td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Belum ada absensi saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
