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
                <select name="matakuliah" class="select select-primary w-full">
                    @foreach (Session::get('listMataKuliah') as $matkul)
                        <option value="{{ $matkul['nama'] . '-' . $matkul['jurusan'] }}">{{ $matkul['nama'] }}</option>
                    @endforeach
                </select>
                {{-- Hari --}}
                <label class="label">
                    <span class="label-text">Hari</span>
                </label>
                <select name="hari" class="select select-primary w-full">
                    <option value="Senin" selected>Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                </select>
                <label class="label">
                    <span class="label-text">Jam</span>
                </label>
                <select name="jam" class="select select-primary w-full">
                    <option value="08:00 - 10:30" selected>08:00 - 10:30</option>
                    <option value="10:30 - 13:00">10:30 - 13:00</option>
                    <option value="13:00 - 15.30">13:00 - 15.30</option>
                    <option value="15:30 - 18:00">15:30 - 18:00</option>
                    <option value="18:00 - 20:30">18:00 - 20:30</option>
                </select>
                {{-- Periode --}}
                <label class="label">
                    <span class="label-text">Periode</span>
                </label>
                <select name="periode" class="select select-primary w-full">
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
                {{-- Dosen Pengajar --}}
                <label class="label">
                    <span class="label-text">Dosen Pengajar</span>
                </label>
                <select name="dosen" class="select select-primary w-full">
                    @foreach (Session::get('listDosen') as $dosen)
                        <option value="{{ $dosen['nama'] . '-' . $dosen['jurusan'] }}">{{ $dosen['nama'] }}</option>
                    @endforeach
                </select>
                <button class="btn bg-primary my-6">Tambah</button>
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
