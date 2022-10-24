@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Absensi Kelas</div>
        <form action="{{ route('dosen-kelas-create-absensi', $detail['id']) }}" method="POST"
            class="form-control w-full px-12">
            @csrf

            {{-- MINGGU KE --}}
            <label class="label">
                <span class="label-text">Minggu Ke - </span>
            </label>
            <input type="number" name="minggu" value="{{ old('minggu') }}" placeholder="Minggu Ke -"
                class="input input-bordered input-primary w-full bg-white" />
            @error('minggu')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- MATERI --}}
            <label class="label">
                <span class="label-text">Materi</span>
            </label>
            <input type="text" name="materi" value="{{ old('materi') }}" placeholder="Materi"
                class="input input-bordered input-primary w-full bg-white" />
            @error('materi')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- DESKRIPSI --}}
            <label class="label">
                <span class="label-text">Deskripsi</span>
            </label>
            <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Deskripsi"
                class="input input-bordered input-primary w-full bg-white" />
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
                        @foreach ($detail['mahasiswa'] as $key => $mahasiswa)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $mahasiswa }}</td>
                                @foreach (Session::get('listUser') as $user)
                                    @if ($user['username'] == $mahasiswa)
                                        <td>{{ $user['nama'] }}</td>
                                    @break
                                @endif
                            @endforeach
                            <td>
                                <input type="checkbox" name="hadir[]" value="{{ $mahasiswa }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <button class="btn btn-info mt-8">Simpan</button>
    </form>
</div>
@endsection
