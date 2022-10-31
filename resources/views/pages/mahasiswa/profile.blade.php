@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Profile Mahasiswa</div>
        <div class="card lg:card-side lg-w-1/2 bg-base-100">
            <figure><img src="https://placeimg.com/400/300/arch" alt="Foto Mahasiswa" class="rounded h-full" /></figure>
            <div class="card-body bg-secondary bg-opacity-90">
                <form action="{{ route('mahasiswa-edit-profile') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $mahasiswa->id }}">

                    {{-- NRP --}}
                    <h2 class="card-title">NRP : {{ $mahasiswa->mahasiswa_nrp }}</h2>

                    {{-- Nama --}}
                    <p>Nama : {{ $mahasiswa->mahasiswa_nama }}</p>

                    {{-- Email --}}
                    <p>Email :
                        <input type="email" name="email" value="{{ $mahasiswa->mahasiswa_email }}" placeholder="Email"
                            class="input input-ghost w-full font-medium">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </p>

                    {{-- Nomor --}}
                    <p>Nomor Telepon :
                        <input type="tel" name="telepon" value="{{ $mahasiswa->mahasiswa_telepon }}"
                            placeholder="Nomor Telepon" class="input input-ghost w-full font-medium">
                        @error('telepon')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </p>

                    {{-- Tanggal --}}
                    <p>Tanggal Lahir : {{ date('d F Y', strtotime($mahasiswa->mahasiswa_tanggal_lahir)) }}</p>
                    <p>Jurusan Lulusan : {{ $mahasiswa->jurusan_nama }}</p>

                    {{-- Tahun Angkatan --}}
                    <p>Tahun Angkatan : {{ $mahasiswa->mahasiswa_angkatan }}</p>

                    {{-- Password --}}
                    <p>Password :
                        <input type="password" name="password" value="{{ $mahasiswa->mahasiswa_password }}"
                            placeholder="Password" class="input input-ghost w-full font-medium">
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </p>

                    {{-- Confirm Password --}}
                    <p>Confirm Password :
                        <input type="password" name="password_confirmation" value="" placeholder="Confirm Password"
                            class="input input-ghost w-full font-medium">
                        @error('password_confirmation')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </p>

                    {{-- Button Edit --}}
                    <div class="card-actions justify-end">
                        <button class="btn btn-info mt-4">Edit Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
