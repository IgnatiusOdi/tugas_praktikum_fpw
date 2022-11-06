@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Module Kelas</div>
        <form action="{{ route('dosen-kelas-create-module', $kelas->id) }}" method="POST" class="form-control w-full px-12">
            @csrf

            {{-- NAMA --}}
            <label class="label">
                <span class="label-text">Nama</span>
            </label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama"
                class="input input-bordered input-primary w-full bg-white" />
            @error('nama')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- KETERANGAN --}}
            <label class="label">
                <span class="label-text">Keterangan</span>
            </label>
            <input type="text" name="keterangan" value="{{ old('keterangan') }}" placeholder="Keterangan"
                class="input input-bordered input-primary w-full bg-white" />
            @error('keterangan')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- JENIS --}}
            <label class="label">
                <span class="label-text">Jenis</span>
            </label>
            <select name="jenis" class="select select-primary w-full bg-white">
                <option value="Assignment">Assignment</option>
                <option value="Quiz">Quiz</option>
            </select>
            @error('jenis')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- DEADLINE --}}
            <label class="label">
                <span class="label-text">Deadline</span>
            </label>
            <input type="datetime-local" name="deadline" value="{{ old('deadline') }}"
                class="input input-bordered input-primary w-full bg-white" />
            @error('deadline')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <button class="btn btn-info mt-8">Buat</button>
        </form>
    </div>
@endsection
