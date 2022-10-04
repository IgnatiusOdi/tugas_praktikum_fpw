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
                    <h2 class="card-title">Nama : {{ Session::get('dosen')['nama'] }}</h2>
                    <input type="hidden" name="nama" value="{{ Session::get('dosen')['nama'] }}">
                    <p>Username :
                        <input type="text" name="username" value="{{ Session::get('dosen')['username'] }}"
                            placeholder="Username" class="input input-ghost w-full font-medium">
                    </p>
                    <p>Email :
                        <input type="email" name="email" value="{{ Session::get('dosen')['email'] }}"
                            placeholder="Email" class="input input-ghost w-full font-medium">
                    </p>
                    <p>Nomor Telepon :
                        <input type="tel" name="nomor" value="{{ Session::get('dosen')['nomor'] }}"
                            placeholder="Nomor Telepon" class="input input-ghost w-full font-medium">
                    </p>
                    <p>Tanggal Lahir : {{ date('d F Y', strtotime(Session::get('dosen')['tanggal'])) }}</p>
                    <p>Jurusan Lulusan :
                        @if (Session::get('dosen')['jurusan'] == 'INF')
                            S1-Informatika
                        @elseif (Session::get('dosen')['jurusan'] == 'SIB')
                            S1-Sistem Informasi Bisnis
                        @elseif (Session::get('dosen')['jurusan'] == 'DKV')
                            S1-Desain Komunikasi Visual
                        @endif
                    </p>
                    <p>Tahun Kelulusan : {{ Session::get('dosen')['tahun'] }}</p>
                    <p>Password :
                        <input type="password" name="password" value="{{ Session::get('dosen')['password'] }}"
                            placeholder="Password" class="input input-ghost w-full font-medium">
                    </p>
                    <p>Confirm Password :
                        <input type="password" name="confirmation" value="" placeholder="Confirm Password"
                            class="input input-ghost w-full font-medium">
                    </p>
                    <div class="card-actions justify-end">
                        <button class="btn btn-info mt-4">Edit Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
