@extends('layouts.main')

@section('title', "REGISTER")

@section('main')
    <div class="bg-secondary-focus min-h-screen">
        <div class="flex flex-col items-center justify-center mx-auto h-screen">
            <div class="text-5xl font-black mb-5">iH - class</div>
            <div class="card w-1/2">
                <form action="" method="" class="form-control bg-secondary px-16 py-12">
                    <div class="text-2xl font-bold text-center mb-4">Register Mahasiswa</div>
                    <label class="label">
                        <span class="label-text">Nama Lengkap</span>
                    </label>
                    <input type="text" placeholder="Nama Lengkap"
                        class="input input-bordered input-primary w-full bg-white" />
                    <label class="label">
                        <span class="label-text">Username</span>
                    </label>
                    <input type="text" placeholder="Username"
                        class="input input-bordered input-primary w-full bg-white" />
                    <label class="label">
                        <span class="label-text">Jurusan</span>
                    </label>
                    <select class="select select-primary w-full bg-white">
                        <option>S1-INF</option>
                        <option>S1-SIB</option>
                        <option>S1-DKV</option>
                    </select>
                    <label class="label">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="Password"
                        class="input input-bordered input-primary w-full bg-white" />
                    <label class="label">
                        <span class="label-text">Confirm Password</span>
                    </label>
                    <input type="password" placeholder="Confirm Password"
                        class="input input-bordered input-primary w-full bg-white" />
                    <button class="btn bg-primary my-6">Register</button>
                    <span>
                        Already have an account? <a href="{{ route('login') }}" class="text-blue-500">Login</a>
                    </span>
                </form>
            </div>
        </div>
    </div>
@endsection
