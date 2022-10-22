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
                    $tipe = Session::has('editMatkul') ? 'Edit' : 'Tambah';
                @endphp

                <div class="text-2xl font-bold text-center mb-4">{{ $tipe }} Mata Kuliah</div>

                {{-- Nama --}}
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" name="nama" value="{{ old('nama', Session::get('editMatkul')['nama'] ?? '') }}"
                    placeholder="Nama" class="input input-bordered input-primary w-full bg-white" />
                @error('nama')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Jurusan --}}
                <label class="label">
                    <span class="label-text">Jurusan</span>
                </label>
                <select name="jurusan" value="{{ old('jurusan', Session::get('editMatkul')['jurusan'] ?? '') }}"
                    class="select select-primary w-full bg-white" {{ Session::has('editMatkul') ? 'disabled' : '' }}>
                    <option value="INF">S1-Informatika</option>
                    <option value="SIB">S1-Sistem Informasi Bisnis</option>
                    <option value="DKV">S1-Desain Komunikasi Visual</option>
                </select>
                @error('jurusan')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Semester --}}
                <label class="label">
                    <span class="label-text">Minimal Semester</span>
                </label>
                <input type="number" name="semester"
                    value="{{ old('semester', Session::get('editMatkul')['semester'] ?? '') }}"
                    placeholder="Minimal Semester" class="input input-bordered input-primary w-full bg-white" />
                @error('semester')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- SKS --}}
                <label class="label">
                    <span class="label-text">SKS</span>
                </label>
                <input type="number" name="sks" value="{{ old('sks', Session::get('editMatkul')['sks'] ?? '') }}"
                    placeholder="SKS" class="input input-bordered input-primary w-full bg-white" />
                @error('sks')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Button Edit / Tambah --}}
                <button class="btn bg-primary my-6" name="button"
                    value="{{ $tipe }}">{{ $tipe }}</button>
                <input type="hidden" name="kode" value="{{ Session::get('editMatkul')['kode'] ?? '' }}">
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
                    @forelse (Session::get('listMataKuliah') as $matkul)
                        <tr>
                            <th>{{ $matkul['kode'] }}</th>
                            <td>{{ $matkul['nama'] }}</td>
                            <td>
                                @if ($matkul['jurusan'] == 'INF')
                                    S1-Informatika
                                @elseif ($matkul['jurusan'] == 'SIB')
                                    S1-Sistem Informasi Bisnis
                                @elseif ($matkul['jurusan'] == 'DKV')
                                    S1-Desain Komunikasi Visual
                                @endif
                            </td>
                            <td>{{ $matkul['semester'] }}</td>
                            <td>{{ $matkul['sks'] }}</td>
                            <td>
                                <form action="{{ route('admin-action-matakuliah') }}" method="POST">
                                    @csrf
                                    <button name="edit" value="{{ $matkul['kode'] }}"
                                        class="btn btn-info w-1/3">Edit</button>
                                    <button name="delete" value="{{ $matkul['kode'] }}"
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
