@extends('layouts.admin')

@section('title', 'MATA KULIAH')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">Mata Kuliah</div>
        <div class="flex flex-col items-center">
            <form action="{{ route('admin-tambah-matakuliah') }}" method="POST"
                class="form-control bg-secondary px-16 py-6 w-full lg:w-1/2">
                @csrf
                @php
                    $tipe = Session::has('editMatakuliah') ? 'Edit' : 'Tambah';
                @endphp

                <div class="text-2xl font-bold text-center mb-4">{{ $tipe }} Mata Kuliah</div>

                {{-- Nama --}}
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" name="nama"
                    value="{{ old('nama', Session::get('editMatakuliah')->matakuliah_nama ?? '') }}" placeholder="Nama"
                    class="input input-bordered input-primary w-full bg-white" />
                @error('nama')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Jurusan --}}
                <label class="label">
                    <span class="label-text">Jurusan</span>
                </label>
                <select name="jurusan" class="select select-primary w-full bg-white"
                    {{ Session::has('editMatakuliah') ? 'disabled' : '' }}>
                    @foreach ($listJurusan as $jurusan)
                        @if (Session::has('editMatakuliah'))
                            <option value="{{ $jurusan->id }}" @if (Session::get('editMatakuliah')->jurusan_id == $jurusan->id) selected @endif>
                                {{ $jurusan->jurusan_nama }}</option>
                        @else
                            <option value="{{ $jurusan->id }}">{{ $jurusan->jurusan_nama }}</option>
                        @endif
                    @endforeach
                </select>
                @error('jurusan')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Semester --}}
                <label class="label">
                    <span class="label-text">Minimal Semester</span>
                </label>
                <input type="number" name="semester"
                    value="{{ old('semester', Session::get('editMatakuliah')->matakuliah_semester ?? '') }}"
                    placeholder="Minimal Semester" class="input input-bordered input-primary w-full bg-white" />
                @error('semester')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- SKS --}}
                <label class="label">
                    <span class="label-text">SKS</span>
                </label>
                <input type="number" name="sks"
                    value="{{ old('sks', Session::get('editMatakuliah')->matakuliah_sks ?? '') }}" placeholder="SKS"
                    class="input input-bordered input-primary w-full bg-white" />
                @error('sks')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Button Edit / Tambah --}}
                <button class="btn bg-primary my-6" name="button"
                    value="{{ $tipe }}">{{ $tipe }}</button>
                <input type="hidden" name="id" value="{{ Session::get('editMatakuliah')->id ?? '' }}">
            </form>
        </div>
        <div class="overflow-x-auto px-8">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>Jurusan</th>
                        <th>Semester</th>
                        <th>SKS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listMatakuliah as $matakuliah)
                        <tr>
                            <th>{{ $matakuliah->matakuliah_kode }}</th>
                            <td>{{ $matakuliah->matakuliah_nama }}</td>
                            <td>{{ $matakuliah->jurusan_kode }}</td>
                            <td>{{ $matakuliah->matakuliah_semester }}</td>
                            <td>{{ $matakuliah->matakuliah_sks }}</td>
                            <td>
                                <form action="{{ route('admin-action-matakuliah') }}" method="POST">
                                    @csrf
                                    <button name="edit" value="{{ $matakuliah->id }}"
                                        class="btn btn-info w-1/3">Edit</button>
                                    <button name="delete" value="{{ $matakuliah->id }}"
                                        class="btn btn-error w-1/3">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center font-bold">Tidak ada mata kuliah saat ini!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
