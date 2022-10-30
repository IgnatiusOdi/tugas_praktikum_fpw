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
                    @foreach ($listMatakuliah as $matakuliah)
                        @if (Session::has('editKelas'))
                            <option value="{{ $matakuliah->id }}" @if (Session::get('editKelas')->matakuliah_id == $matakuliah->id) selected @endif>
                                {{ $matakuliah->matakuliah_nama }}</option>
                        @else
                            <option value="{{ $matakuliah->id }}">{{ $matakuliah->matakuliah_nama }}</option>
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
                    @foreach ($listHari as $hari)
                        @if (Session::has('editKelas'))
                            <option value="{{ $hari->id }}" @if (Session::get('editKelas')->hari_id == $hari->id) selected @endif>
                                {{ $hari->hari_nama }}</option>
                        @else
                            <option value="{{ $hari->id }}">{{ $hari->hari_nama }}</option>
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
                <select name="jam" class="select select-primary w-full bg-white">
                    @foreach ($listJam as $jam)
                        @if (Session::has('editKelas'))
                            <option value="{{ $jam->id }}" @if (Session::get('editKelas')->jam_id == $jam->id) selected @endif>
                                {{ $jam->jam_nama }}</option>
                        @else
                            <option value="{{ $jam->id }}">{{ $jam->jam_nama }}</option>
                        @endif
                    @endforeach
                </select>
                {{-- <input type="time" name="jam" value="{{ old('jam', Session::get('editKelas')['jam'] ?? '') }}"
                    class="input input-bordered input-primary w-full bg-white" /> --}}
                @error('jam')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Periode --}}
                <label class="label">
                    <span class="label-text">Periode</span>
                </label>
                <select name="periode" class="select select-primary w-full bg-white">
                    @foreach ($listPeriode as $periode)
                        @if (Session::has('editKelas'))
                            <option value="{{ $periode->id }}" @if (Session::get('editKelas')->periode_id == $periode->id) selected @endif>
                                {{ $periode->periode_tahun }}</option>
                        @else
                            <option value="{{ $periode->id }}">{{ $periode->periode_tahun }}</option>
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
                <select name="dosen" class="select select-primary w-full bg-white"
                    {{ Session::has('editKelas') ? 'disabled' : '' }}>
                    @foreach ($listDosen as $dosen)
                        @if (Session::has('editKelas'))
                            <option value="{{ $dosen->id }}" @if (Session::get('editKelas')->dosen_id == $dosen->id) selected @endif>
                                {{ $dosen->dosen_nama }}</option>
                        @else
                            <option value="{{ $dosen->id }}">{{ $dosen->dosen_nama }}</option>
                        @endif
                    @endforeach
                </select>
                @error('dosen')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Button Edit / Tambah --}}
                <button class="btn bg-primary my-6" name="button"
                    value="{{ $tipe }}">{{ $tipe }}</button>
                <input type="hidden" name="id" value="{{ Session::get('editKelas')->id ?? '' }}">
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
                    @forelse ($listKelas as $kelas)
                        <tr>
                            <th>{{ $kelas->matakuliah_nama }}</th>
                            <td>{{ $kelas->hari_nama }}</td>
                            <td>{{ $kelas->jam_nama }}</td>
                            <td>{{ $kelas->periode_tahun }}</td>
                            <td>{{ $kelas->dosen_nama }}</td>
                            <td>
                                <form action="{{ route('admin-action-kelas') }}" method="POST">
                                    @csrf
                                    <button name="edit" value="{{ $kelas->id }}"
                                        class="btn btn-info w-1/3">Edit</button>
                                    <button name="delete" value="{{ $kelas->id }}"
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
