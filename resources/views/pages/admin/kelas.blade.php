@extends('layouts.admin')

@section('title', 'KELAS')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">Kelas</div>
        <div class="flex flex-col items-center">
            <form action="{{ route('admin-tambah-kelas') }}" method="POST"
                class="form-control bg-secondary px-16 py-6 w-full lg:w-1/2">
                @csrf
                @php
                    $tipe = Session::has('editKelas') ? 'Edit' : 'Tambah';
                @endphp

                <div class="text-2xl font-bold text-center mb-4">{{ $tipe }} Kelas</div>

                {{-- Mata Kuliah --}}
                <label class="label">
                    <span class="label-text">Mata Kuliah</span>
                </label>
                <select name="matakuliah" class="select select-primary w-full bg-white">
                    @foreach (Session::get('listMataKuliah') as $matkul)
                        @if (Session::has('editKelas') && Session::get('editKelas')['matakuliah'] == $matkul['nama'])
                            <option value="{{ $matkul['nama'] . '-' . $matkul['jurusan'] }}" selected>
                                {{ $matkul['nama'] }}
                            </option>
                        @else
                            <option value="{{ $matkul['nama'] . '-' . $matkul['jurusan'] }}">
                                {{ $matkul['nama'] }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('matakuliah')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Hari --}}
                <label class="label">
                    <span class="label-text">Hari</span>
                </label>
                <select name="hari" class="select select-primary w-full bg-white">
                    @php
                        $listHari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
                    @endphp
                    @foreach ($listHari as $hari)
                        @if (Session::has('editKelas') && Session::get('editKelas')['hari'] == $hari)
                            <option value="{{ $hari }}" selected>{{ $hari }}</option>
                        @else
                            <option value="{{ $hari }}">{{ $hari }}</option>
                        @endif
                    @endforeach
                </select>
                @error('hari')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Jam --}}
                <label class="label">
                    <span class="label-text">Jam</span>
                </label>
                <input type="time" name="jam" value="{{ old('jam', Session::get('editKelas')['jam'] ?? '') }}"
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
                        @if (Session::has('editKelas') && Session::get('editKelas')['periode'] == $periode)
                            <option value="{{ $periode['tahun'] }}" selected>
                                @php
                                    $p = explode('-', $periode['tahun']);
                                    $p = $p[0] . '/' . $p[1];
                                @endphp
                                {{ $p }}
                            </option>
                        @else
                            <option value="{{ $periode['tahun'] }}">
                                @php
                                    $p = explode('-', $periode['tahun']);
                                    $p = $p[0] . '/' . $p[1];
                                @endphp
                                {{ $p }}
                            </option>
                        @endif
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
                            @if (Session::has('editKelas') && Session::get('editKelas')['dosen'] == $dosen['nama'])
                                <option value="{{ $dosen['nama'] . '-' . $dosen['jurusan'] }}" selected>
                                    {{ $dosen['nama'] }}</option>
                            @else
                                <option value="{{ $dosen['nama'] . '-' . $dosen['jurusan'] }}">{{ $dosen['nama'] }}
                                </option>
                            @endif
                        @endif
                    @endforeach
                </select>
                @error('dosen')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Button Edit / Tambah --}}
                <button class="btn bg-primary my-6" name="button"
                    value="{{ $tipe }}">{{ $tipe }}</button>
                <input type="hidden" name="id" value="{{ Session::get('editKelas')['id'] ?? '' }}">
            </form>
        </div>
        <div class="overflow-x-auto px-8">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
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
                                <form action="{{ route('admin-action-kelas') }}" method="POST">
                                    @csrf
                                    <button name="edit" value="{{ $kelas['id'] }}"
                                        class="btn btn-info w-1/3">Edit</button>
                                    <button name="matakuliah" value="{{ $kelas['id'] }}"
                                        class="btn btn-error w-1/3">Delete</button>
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
