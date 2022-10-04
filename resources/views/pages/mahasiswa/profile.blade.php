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
                    <h2 class="card-title">Nama : {{ Session::get('mahasiswa')['nama'] }}</h2>
                    <input type="hidden" name="nama" value="{{ Session::get('mahasiswa')['nama'] }}">
                    <p>NRP : {{ Session::get('mahasiswa')['nrp'] }}</p>
                    <input type="hidden" name="nrp" value="{{ Session::get('mahasiswa')['nrp'] }}">
                    <p>Email :
                        <input type="email" name="email" value="{{ Session::get('mahasiswa')['email'] }}"
                            placeholder="Email" class="input input-ghost w-full font-medium">
                    </p>
                    <p>Nomor Telepon :
                        <input type="tel" name="nomor" value="{{ Session::get('mahasiswa')['nomor'] }}"
                            placeholder="Nomor Telepon" class="input input-ghost w-full font-medium">
                    </p>
                    <p>Tanggal Lahir : {{ date('d F Y', strtotime(Session::get('mahasiswa')['tanggal'])) }}</p>
                    <p>Jurusan Lulusan :
                        @if (Session::get('mahasiswa')['jurusan'] == 'INF')
                            S1-Informatika
                        @elseif (Session::get('mahasiswa')['jurusan'] == 'SIB')
                            S1-Sistem Informasi Bisnis
                        @elseif (Session::get('mahasiswa')['jurusan'] == 'DKV')
                            S1-Desain Komunikasi Visual
                        @endif
                    </p>
                    <p>Tahun Angkatan : {{ Session::get('mahasiswa')['tahun'] }}</p>
                    <p>Password :
                        <input type="password" name="password" value="{{ Session::get('mahasiswa')['password'] }}"
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
