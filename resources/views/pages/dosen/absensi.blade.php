@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Absensi Kelas</div>
        @if (Session::has('editAbsensi'))
            <form action="{{ route('dosen-kelas-create-absensi', $id, $absensi) }}" method="POST"
                class="form-control w-full px-12">
            @else
                <form action="{{ route('dosen-kelas-create-absensi', $kelas->id) }}" method="POST"
                    class="form-control w-full px-12">
        @endif
        @csrf

        {{-- MINGGU KE --}}
        <label class="label">
            <span class="label-text">Minggu Ke - </span>
        </label>
        <input type="number" name="minggu" value="{{ old('minggu', $materi->materi_minggu ?? '') }}"
            placeholder="Minggu Ke -" class="input input-bordered input-primary w-full bg-white" />
        @error('minggu')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        {{-- MATERI --}}
        <label class="label">
            <span class="label-text">Materi</span>
        </label>
        <input type="text" name="materi" value="{{ old('materi', $materi->materi_judul ?? '') }}" placeholder="Materi"
            class="input input-bordered input-primary w-full bg-white" />
        @error('materi')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        {{-- DESKRIPSI --}}
        <label class="label">
            <span class="label-text">Deskripsi</span>
        </label>
        <input type="text" name="deskripsi" value="{{ old('deskripsi', $materi->materi_deskripsi ?? '') }}"
            placeholder="Deskripsi" class="input input-bordered input-primary w-full bg-white" />
        @error('deskripsi')
            <span class="text-red-500">{{ $message }}</span>
        @enderror

        {{-- LIST MAHASISWA --}}
        <label class="label">
            <span class="label-text">List Mahasiswa</span>
        </label>
        <div class="overflow-x-auto">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NRP</th>
                        <th>Nama</th>
                        <th>Hadir</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listMahasiswa as $key => $mahasiswa)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $mahasiswa->mahasiswa_nrp }}</td>
                            <td>{{ $mahasiswa->mahasiswa_nama }}</td>
                            <td>
                                @if (Session::has('editAbsensi'))
                                    <input type="checkbox" name="hadir[]" value="{{ $mahasiswa->id }}"
                                        @if ($mahasiswa->absensi_status == 1) checked @endif>
                                @else
                                    <input type="checkbox" name="hadir[]" value="{{ $mahasiswa->id }}">
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button class="btn btn-info mt-8">Simpan</button>
        <input type="hidden" name="absensi" value="{{ Session::has('editAbsensi') ? $absensi : '' }}">
        </form>
    </div>
@endsection
