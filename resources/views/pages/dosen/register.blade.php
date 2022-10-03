@extends('layouts.main')

@section('title', 'REGISTER')

@section('main')
    <div class="bg-secondary-focus min-h-screen">
        <div class="flex flex-col items-center justify-center mx-auto px-6 py-6 min-h-screen">
            <div class="text-5xl font-black mb-5">iH - class</div>
            <div class="card w-full lg:w-1/2">
                <form action="{{ route('try-register-dosen') }}" method="POST" class="form-control bg-secondary px-16 py-12">
                    @csrf
                    <div class="text-2xl font-bold text-center mb-4">Register Dosen</div>
                    {{-- Nama Lengkap --}}
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Username --}}
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" value="{{ old('username') }}" placeholder="Username"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Email --}}
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Nomor Telepon --}}
                    <label class="label">
                        <span class="label-text">Nomor Telepon</span>
                    </label>
                    <input type="tel" name="nomor" value="{{ old('nomor') }}" placeholder="Nomor Telepon"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Tanggal Lahir --}}
                    <label class="label">
                        <span class="label-text">Tanggal Lahir</span>
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" placeholder="Tanggal Lahir"
                        class="input input-bordered input-primary w-full bg-white">
                    {{-- Jurusan Lulusan --}}
                    <label class="label">
                        <span class="label-text">Jurusan Lulusan</span>
                    </label>
                    <select name="jurusan" value="{{ old('jurusan') }}" class="select select-primary w-full bg-white">
                        <option value="INF" selected>S1-Informatika</option>
                        <option value="SIB">S1-Sistem Informasi Bisnis</option>
                        <option value="DKV">S1-Desain Komunikasi Visual</option>
                    </select>
                    {{-- Tahun Kelulusan --}}
                    <label class="label">
                        <span class="label-text">Tahun Kelulusan</span>
                    </label>
                    <input type="number" name="tahun" value="{{ old('tahun') }}" placeholder="Tahun Kelulusan"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Password --}}
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="Password"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Confirm Password --}}
                    <label class="label">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" name="confirmation" placeholder="Confirm Password"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Syarat dan Ketentuan --}}
                    <label class="label cursor-pointer">
                        <input type="checkbox" name="snk" class="checkbox checkbox-lg">
                        <span class="label-text ml-4 mr-auto">Dengan ini saya membaca, memahami, dan menyetujui hal-hal yang
                            tercantum <br>pada <span class="text-blue-400">Syarat dan Ketentuan</span> yang berlaku.</span>
                    </label>
                    <button class="btn bg-primary my-6">Register</button>
                    <span>
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500">Login</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
