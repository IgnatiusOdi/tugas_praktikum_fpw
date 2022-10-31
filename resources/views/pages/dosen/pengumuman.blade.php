@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Pengumuman Kelas</div>
        <form action="{{ route('dosen-kelas-create-pengumuman', $id) }}" method="POST" class="form-control w-full px-12">
            @csrf

            {{-- DESKRIPSI --}}
            <label class="label">
                <span class="label-text">Deskripsi</span>
            </label>
            <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" placeholder="Deskripsi"
                class="input input-bordered input-primary w-full bg-white" />
            @error('deskripsi')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            {{-- LINK --}}
            <label class="label">
                <span class="label-text">Link</span>
            </label>
            <input type="text" name="link" value="{{ old('link') }}" placeholder="Link"
                class="input input-bordered input-primary w-full bg-white" />
            @error('link')
                <span class="text-red-500">{{ $message }}</span>
            @enderror

            <button class="btn btn-info mt-8">Buat</button>
        </form>
    </div>
@endsection
