@extends('layouts.main')

@section('title', 'REGISTER')

@section('main')
    <div class="bg-secondary-focus min-h-screen">
        <div class="flex flex-col items-center justify-center mx-auto h-screen">
            <div class="text-5xl font-black mb-5">iH - class</div>
            <div class="card w-1/2">
                <form action="{{ route('try-register-dosen') }}" method="POST" class="form-control bg-secondary px-16 py-12">
                    @csrf
                    <div class="text-2xl font-bold text-center mb-4">Register Dosen</div>
                    {{-- Username --}}
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" placeholder="Username"
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
                    {{-- Tahun Kelulusan --}}
                    <label class="label">
                        <span class="label-text">Tahun Kelulusan</span>
                    </label>
                    <input type="number" name="tahun" placeholder="Tahun Kelulusan"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Jurusan Lulusan --}}
                    <label class="label">
                        <span class="label-text">Jurusan Lulusan</span>
                    </label>
                    <input type="text" name="jurusan" placeholder="Jurusan Lulusan, ex: S2 / Magister Informatika"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Nama Lengkap --}}
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" name="nama_lengkap" placeholder="Nama Lengkap"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Tanggal Lahir --}}
                    <label class="label">
                        <span class="label-text">Tanggal Lahir</span>
                    </label>
                    <input type="date" name="tanggal_lahir" placeholder="Tanggal Lahir"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Email --}}
                    <label class="label">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" name="email" placeholder="Email, ex: alexa@gmail.com"
                        class="input input-bordered input-primary w-full bg-white" />
                    {{-- Nomor Telepon --}}
                    <label class="label">
                        <span class="label-text">Nomor telepon</span>
                    </label>
                    <input type="tel" name="nomor_telepon" placeholder="Nomor Telepon, ex: 0812-3456-7899"
                        pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" class="input input-bordered input-primary w-full bg-white" />
                    {{-- Konfirmasi Syarat dan Ketentuan --}}
                    <div class="form-control">
                        <label class="cursor-pointer label">
                            <span class="label-text">Remember me</span>
                            <input type="checkbox" checked="checked" class="checkbox checkbox-secondary" />
                        </label>
                        <label class="cursor-pointer label">
                            <span class="label-text">Remember me</span>
                            <input type="checkbox" checked="checked" class="checkbox checkbox-secondary" />
                        </label>
                        <label class="cursor-pointer label">
                            <span class="label-text">Remember me</span>
                            <input type="checkbox" checked="checked" class="checkbox checkbox-secondary" />
                        </label>
                    </div>

                    <button class="btn bg-primary my-6">Register</button>
                    <span>
                        Already have an account? <a href="{{ route('login') }}" class="text-blue-500">Login</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
