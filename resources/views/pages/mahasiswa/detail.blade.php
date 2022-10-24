@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="font-bold text-3xl p-8">Detail Kelas</div>
    <div class="ml-6">
        <div>Mata Kuliah : {{ $detail['matakuliah'] }}</div>
        <div>Hari : {{ $detail['hari'] }}</div>
        <div>Jam : {{ $detail['jam'] }}</div>
        <div>Periode : {{ $detail['periode'] }}</div>
        <div>Dosen : {{ $detail['dosen'] }}</div>

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
                @forelse ($detail['absensi'] as $absen)
                    @php
                        $kehadiran = false;
                    @endphp
                    <tr>
                        <td>{{ $absen['minggu'] }}</td>
                        <td>{{ $absen['materi'] }}</td>
                        <td>{{ $absen['deskripsi'] }}</td>
                        @foreach ($absen['hadir'] as $hadir)
                            @if ($hadir == Session::get('mahasiswa')['username'])
                                <td>V</td>
                                @php
                                    $kehadiran = true;
                                @endphp
                            @break
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
