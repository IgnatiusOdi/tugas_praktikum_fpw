@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="font-bold text-5xl p-10">Welcome, {{ $mahasiswa->mahasiswa_nama }}!</div>

    {{-- SEARCH --}}
    <form action="{{ route('mahasiswa-find') }}" method="get">
        <select name="role">
            <option value="dosen">Dosen</option>
            <option value="mahasiswa">Mahasiswa</option>
        </select>
        <input type="text" name="nama" value="{{ old('nama') }}" placeholder="nama">
        <button class="btn btn-info">Search</button>
    </form>

    {{-- MODULE AKTIF --}}
    <div class="font-bold text-3xl text-center mb-4">Module Aktif</div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>Kelas</th>
                    <th>Module</th>
                    <th>Jenis</th>
                    <th>Deadline</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listTergabung as $tergabung)
                    @php
                        $listModule = App\Models\Module::where('kelas_id', $tergabung->kelas_id)
                            ->where('module_status', 1)
                            ->get();
                    @endphp
                    @foreach ($listModule as $module)
                        <tr>
                            <td>{{ $module->kelas->matakuliah->matakuliah_nama }}</td>
                            <td>{{ $module->module_nama }}</td>
                            <td>{{ $module->module_jenis }}</td>
                            <td>{{ $module->module_deadline }}</td>
                            <td>
                                <form action="{{ route('mahasiswa-view-module', $module->id) }}" method="GET">
                                    <button class="btn btn-info w-2/3">Detail</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

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
                @forelse ($listTergabung as $tergabung)
                    @php
                        $listPengumuman = App\Models\Pengumuman::where('kelas_id', $tergabung->kelas_id)->get();
                    @endphp
                    @foreach ($listPengumuman as $pengumuman)
                        <tr>
                            <td colspan="3">
                                {{ $pengumuman->kelas->matakuliah->matakuliah_nama }} -
                                <b>{{ $pengumuman->pengumuman_deskripsi }}</b>
                                <a>{{ $pengumuman->pengumuman_link }}</a>
                            </td>
                        </tr>
                    @endforeach
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
                @forelse ($listTergabung as $tergabung)
                    @php
                        $listAbsensi = App\Models\Absensi::where('mahasiswa_id', $tergabung->mahasiswa_id)->get();
                    @endphp
                    @foreach ($listAbsensi as $absensi)
                        <tr>
                            <td>Minggu ke-{{ $absensi->materi->materi_minggu }}</td>
                            <td>{{ $absensi->materi->materi_judul }}</td>
                            <td>{{ $absensi->materi->materi_deskripsi }}</td>
                            <th>
                                @if ($absensi->absensi_status == 1)
                                    Hadir
                                @else
                                    Tidak Hadir
                                @endif
                            </th>
                        </tr>
                    @endforeach
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
                    @if ($kelas->matakuliah->jurusan_id == $mahasiswa->jurusan_id)
                        <tr>
                            <th>{{ $kelas->matakuliah->matakuliah_nama }}</th>
                            <td>{{ $kelas->hari->hari_nama }}</td>
                            <td>{{ $kelas->jam->jam_nama }}</td>
                            <td>{{ $kelas->periode->periode_tahun }}</td>
                            <td>{{ $kelas->dosen->dosen_nama }}</td>
                            <td>{{ $kelas->matakuliah->matakuliah_semester }}</td>
                            <td>{{ $kelas->matakuliah->matakuliah_sks }}</td>
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
                    @endif
                @empty
                    <tr>
                        <td colspan="8" class="text-center font-bold">Tidak ada kelas saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
