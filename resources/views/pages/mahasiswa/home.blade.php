@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="font-bold text-5xl p-10">Welcome, {{ $mahasiswa->mahasiswa_nama }}!</div>

    {{-- FEEDS --}}
    <div class="font-bold text-3xl text-center mb-4">Feeds</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th colspan="3">Pengumuman</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listPengumuman as $pengumuman)
                    <tr>
                        <td>{{ $pengumuman->matakuliah_nama }}</td>
                        <th>{{ $pengumuman->pengumuman_deskripsi }}</th>
                        <td><a>{{ $pengumuman->pengumuman_link }}</a></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center font-bold">Belum ada pengumuman saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th colspan="4">Absensi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listAbsensi as $absensi)
                    <tr>
                        <td>{{ $absensi->materi_minggu }}</td>
                        <td>{{ $absensi->materi_judul }}</td>
                        <th>{{ $absensi->materi_deskripsi }}</th>
                        <th>
                            @if ($absensi->absensi_status == 1)
                                Hadir
                            @else
                                Tidak Hadir
                            @endif
                        </th>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center font-bold">Belum ada pengumuman saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


    {{-- LIST KELAS --}}
    <div class="font-bold text-3xl text-center mb-4">List Kelas</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Periode</th>
                    <th>Dosen</th>
                    <th>Semester</th>
                    <th>SKS</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 0;
                @endphp
                @forelse ($listKelas as $kelas)
                    <tr>
                        <th>{{ $kelas->matakuliah_nama }}</th>
                        <td>{{ $kelas->hari_nama }}</td>
                        <td>{{ $kelas->jam_nama }}</td>
                        <td>{{ $kelas->periode_tahun }}</td>
                        <td>{{ $kelas->dosen_nama }}</td>
                        <td>{{ $kelas->matakuliah_semester }}</td>
                        <td>{{ $kelas->matakuliah_sks }}</td>
                        <td>
                            <form action="{{ route('mahasiswa-join-kelas') }}" method="POST">
                                @csrf

                                @if (count($listTergabung) > $counter && $kelas->id == $listTergabung[$counter]->kelas_id)
                                    <button name="leave" value="{{ $kelas->id }}"
                                        class="btn btn-error w-2/3">Leave</button>
                                    @php
                                        $counter++;
                                    @endphp
                                @else
                                    <button name="join" value="{{ $kelas->id }}"
                                        class="btn btn-info w-2/3">Join</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center font-bold">Tidak ada kelas saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
