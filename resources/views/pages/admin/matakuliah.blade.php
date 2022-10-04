@extends('layouts.admin')

@section('title', 'MATA KULIAH')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">Mata Kuliah</div>
        <div class="flex flex-col items-center">
            <form action="{{ route('admin-tambah-matakuliah') }}" method="POST"
                class="form-control bg-secondary px-16 py-6 w-full lg:w-1/2">
                @csrf
                <div class="text-2xl font-bold text-center mb-4">Tambah Mata Kuliah</div>
                {{-- Nama --}}
                <label class="label">
                    <span class="label-text">Nama</span>
                </label>
                <input type="text" name="nama" placeholder="Nama"
                    class="input input-bordered input-primary w-full bg-white" />
                {{-- Jurusan --}}
                <label class="label">
                    <span class="label-text">Jurusan</span>
                </label>
                <select name="jurusan" class="select select-primary w-full">
                    <option value="INF" selected>S1-Informatika</option>
                    <option value="SIB">S1-Sistem Informasi Bisnis</option>
                    <option value="DKV">S1-Desain Komunikasi Visual</option>
                </select>
                {{-- Semester --}}
                <label class="label">
                    <span class="label-text">Semester</span>
                </label>
                <input type="number" name="semester" placeholder="Minimum Semester" min="1" max="8"
                    class="input input-bordered input-primary w-full bg-white" />
                <button class="btn bg-primary my-6">Tambah</button>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if (Session::has('listMataKuliah'))
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
                                <td>
                                    <form action="{{ route('admin-hapus-matakuliah') }}" method="POST">
                                        @csrf
                                        <button name="kode" value="{{ $matkul['kode'] }}"
                                            class="btn btn-error w-2/3">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center font-bold">Tidak ada mata kuliah saat ini!</td>
                            </tr>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
