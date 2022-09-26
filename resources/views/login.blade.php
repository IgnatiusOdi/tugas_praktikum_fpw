@extends('layouts.main')

@section('title', "LOGIN")

@section('main')
    <div class="bg-secondary-focus min-h-screen">
        <div class="flex flex-col items-center justify-center mx-auto h-screen">
            <div class="text-5xl font-black mb-5">iH - class</div>
            <div class="card w-fit">
                <form action="{{ route('try-login') }}" method="POST" class="form-control bg-secondary px-16 py-12">
                    @csrf
                    <div class="text-2xl font-bold text-center mb-4">Login</div>
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" name="Username" placeholder="Username"
                        class="input input-bordered input-primary w-full bg-white" />
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" name="Password" placeholder="Password"
                        class="input input-bordered input-primary w-full bg-white" />
                    <span class="text-right">
                        <a href="{{ route('login') }}" class="text-red-500">Forgot Password?</a>
                    </span>
                    <button class="btn bg-primary my-6">Login</button>
                    <span>
                        Not registered as Mahasiswa? <a href="{{ route('register-mahasiswa') }}"
                            class="text-blue-500">Register here</a>
                    </span>
                    <span>
                        Not registered as Dosen? <a href="{{ route('register-dosen') }}" class="text-green-600">Register
                            here</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
