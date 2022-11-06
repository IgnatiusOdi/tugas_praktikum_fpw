@extends('layouts.user')

@section('title', 'PROFILE')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Profile Dosen</div>
        <div class="card lg:card-side lg-w-1/2 bg-base-100">
            <figure><img src="https://placeimg.com/400/300/arch" alt="Foto Dosen" class="rounded h-full" /></figure>
            <div class="card-body bg-secondary bg-opacity-90">
                <form action="{{ route('dosen-edit-profile') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $dosen->id }}">

                    {{-- Nama --}}
                    <h2 class="card-title">Nama : {{ $dosen->dosen_nama }}</h2>

                    {{-- Username --}}
                    <p>Username :
                        <input type="text" name="username" value="{{ $dosen->dosen_username }}" placeholder="Username"
                            class="input input-ghost w-full font-medium">
                        @error('username')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </p>

                    {{-- Email --}}
                    <p>Email :
                        <input type="email" name="email" value="{{ $dosen->dosen_email }}" placeholder="Email"
                            class="input input-ghost w-full font-medium">
                        @error('email')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </p>

                    {{-- Telepon --}}
                    <p>Nomor Telepon :
                        <input type="tel" name="telepon" value="{{ $dosen->dosen_telepon }}" placeholder="Nomor Telepon"
                            class="input input-ghost w-full font-medium">
                        @error('telepon')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </p>

                    {{-- Tanggal Lahir --}}
                    <p>Tanggal Lahir : {{ date('d F Y', strtotime($dosen->dosen_tanggal_lahir)) }}</p>

                    {{-- Jurusan --}}
                    <p>Jurusan Lulusan : {{ $dosen->jurusan->jurusan_nama }}</p>

                    {{-- Tahun Kelulusan --}}
                    <p>Tahun Kelulusan : {{ $dosen->dosen_kelulusan }}</p>

                    {{-- Password --}}
                    <p>Password :
                        <input type="password" name="password" value="{{ $dosen->dosen_password }}" placeholder="Password"
                            class="input input-ghost w-full font-medium">
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
