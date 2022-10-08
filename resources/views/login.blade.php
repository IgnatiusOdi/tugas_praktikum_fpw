@extends('layouts.main')

@section('title', 'LOGIN')

@section('main')
    <div class="bg-secondary-focus min-h-screen">
        <div class="flex flex-col items-center justify-center mx-auto h-screen">
            <div class="text-5xl font-black mb-5">iH - class</div>
            <div class="card w-fit">
                <form action="{{ route('try-login') }}" method="POST" class="form-control bg-secondary px-16 py-12">
                    @csrf
                    <div class="text-2xl font-bold text-center mb-4">Login</div>
                    {{-- Username --}}
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="username" placeholder="Username"
                        class="input input-bordered input-primary w-full bg-white" />
                    @error('username')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    {{-- Password --}}
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="password" placeholder="Password"
                        class="input input-bordered input-primary w-full bg-white" />
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                    <button class="btn bg-primary my-6">Login</button>
                    <span>
                        Belum terdaftar sebagai Mahasiswa? <a href="{{ route('register-mahasiswa') }}"
                            class="text-blue-500">Register here</a>
                    </span>
                    <span>
                        Belum terdaftar sebagai Dosen? <a href="{{ route('register-dosen') }}"
                            class="text-green-600">Register
                            here</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
