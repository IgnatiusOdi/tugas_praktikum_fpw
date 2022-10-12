@extends('layouts.admin')

@section('title', 'KELAS')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">Kelas</div>
        <div class="flex flex-col items-center">
            <form action="{{ route('admin-tambah-kelas') }}" method="POST"
                class="form-control bg-secondary px-16 py-6 w-full lg:w-1/2">
                @csrf
                <div class="text-2xl font-bold text-center mb-4">Tambah Kelas</div>

                {{-- Mata Kuliah --}}
                <label class="label">
                    <span class="label-text">Mata Kuliah</span>
                </label>
                <select name="matakuliah" class="select select-primary w-full bg-white">
                    @foreach (Session::get('listMataKuliah') as $matkul)
                        <option value="{{ $matkul['nama'] . '-' . $matkul['jurusan'] }}">{{ $matkul['nama'] }}</option>
                    @endforeach
                </select>
                @error('matakuliah')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- SKS --}}
                <label class="label">
                    <span class="label-text">SKS</span>
                </label>
                <input type="number" name="sks" value="{{ old('sks') }}" placeholder="SKS"
                    class="input input-bordered input-primary w-full bg-white" />
                @error('sks')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Hari --}}
                <label class="label">
                    <span class="label-text">Hari</span>
                </label>
                <select name="hari" class="select select-primary w-full bg-white">
                    <option value="Senin" selected>Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
                @error('hari')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Jam --}}
                <label class="label">
                    <span class="label-text">Jam</span>
                </label>
                <input type="time" name="jam" value="{{ old('jam') }}"
                    class="input input-bordered input-primary w-full bg-white" />
                @error('jam')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Periode --}}
                <label class="label">
                    <span class="label-text">Periode</span>
                </label>
                <select name="periode" class="select select-primary w-full bg-white">
                    @foreach (Session::get('listPeriode') as $periode)
                        <option value="{{ $periode['tahun'] }}">
                            @php
                                $p = explode('-', $periode['tahun']);
                                $p = $p[0] . '/' . $p[1];
                            @endphp
                            {{ $p }}
                        </option>
                    @endforeach
                </select>
                @error('periode')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Dosen Pengajar --}}
                <label class="label">
                    <span class="label-text">Dosen Pengajar</span>
                </label>
                <select name="dosen" class="select select-primary w-full bg-white">
                    @foreach (Session::get('listUser') as $dosen)
                        @if ($dosen['role'] == 'dosen')
                            <option value="{{ $dosen['nama'] . '-' . $dosen['jurusan'] }}">{{ $dosen['nama'] }}</option>
                        @endif
                    @endforeach
                </select>
                @error('dosen')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Button Tambah --}}
                <button class="btn bg-primary my-6">Tambah</button>
            </form>
        </div>
        <div class="overflow-x-auto px-8">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Periode</th>
                        <th>Dosen Pengajar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (Session::get('listKelas') as $kelas)
                        <tr>
                            <th>{{ $kelas['matakuliah'] }}</th>
                            <td>{{ $kelas['sks'] }}</td>
                            <td>{{ $kelas['hari'] }}</td>
                            <td>{{ $kelas['jam'] }}</td>
                            <td>
                                @php
                                    $p = explode('-', $kelas['periode']);
                                    $p = $p[0] . '/' . $p[1];
                                @endphp
                                {{ $p }}
                            </td>
                            <td>{{ $kelas['dosen'] }}</td>
                            <td>
                                <form action="{{ route('admin-hapus-kelas') }}" method="POST">
                                    @csrf
                                    <button name="matakuliah" value="{{ $kelas['matakuliah'] }}"
                                        class="btn btn-error w-full">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center font-bold">Tidak ada kelas saat ini!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
