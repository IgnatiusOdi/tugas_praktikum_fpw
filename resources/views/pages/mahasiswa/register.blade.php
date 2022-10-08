@extends('layouts.main')

@section('title', 'REGISTER')

@section('main')
    <div class="bg-secondary-focus min-h-screen">
        <div class="flex flex-col items-center justify-center mx-auto px-6 py-6 min-h-screen">
            <div class="text-5xl font-black mb-5">iH - class</div>
            <div class="card w-full lg:w-1/2">
                <form action="{{ route('try-register-mahasiswa') }}" method="POST"
                    class="form-control bg-secondary px-16 py-12">
                    @csrf
                    <div class="text-2xl font-bold text-center mb-4">Register Mahasiswa</div>

                    {{-- Nama Lengkap --}}
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama Lengkap"
                        class="input input-bordered input-primary w-full bg-white" />
                    @error('nama')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    {{-- Email --}}
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="text" name="email" value="{{ old('email') }}" placeholder="Email"
                        class="input input-bordered input-primary w-full bg-white" />
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    {{-- Nomor Telepon --}}
                    <label class="label">
                        <span class="label-text">Nomor Telepon</span>
                    </label>
                    <input type="tel" name="nomor" value="{{ old('nomor') }}" placeholder="Nomor Telepon"
                        class="input input-bordered input-primary w-full bg-white" />
                    @error('nomor')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    {{-- Tanggal Lahir --}}
                    <label class="label">
                        <span class="label-text">Tanggal Lahir</span>
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" placeholder="Tanggal Lahir"
                        class="input input-bordered input-primary w-full bg-white">
                    @error('tanggal')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    {{-- Jurusan --}}
                    <label class="label">
                        <span class="label-text">Jurusan</span>
                    </label>
                    <select name="jurusan" value="{{ old('jurusan') }}" class="select select-primary w-full bg-white">
                        <option value="INF" selected>S1-Informatika</option>
                        <option value="SIB">S1-Sistem Informasi Bisnis</option>
                        <option value="DKV">S1-Desain Komunikasi Visual</option>
                    </select>

                    {{-- Tahun Angkatan --}}
                    <label class="label">
                        <span class="label-text">Tahun Angkatan</span>
                    </label>
                    <input type="number" name="tahun" value="{{ old('tahun') }}" placeholder="Tahun Angkatan"
                        min="{{ date('Y') - 8 }}" max="{{ date('Y') + 1 }}"
                        class="input input-bordered input-primary w-full bg-white" />
                    @error('tahun')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    {{-- Syarat dan Ketentuan --}}
                    <label class="label cursor-pointer">
                        <input type="checkbox" name="snk" class="checkbox checkbox-lg">
                        <span class="label-text ml-4 mr-auto">Dengan ini saya membaca, memahami, dan menyetujui hal-hal yang
                            tercantum <br>pada <span class="text-blue-400">Syarat dan Ketentuan</span> yang berlaku.</span>
                    </label>
                    @error('snk')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror

                    {{-- Button Register --}}
                    <button class="btn bg-primary my-6">Register</button>

                    {{-- Go to Login --}}
                    <span>
                        Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-500">Login</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
