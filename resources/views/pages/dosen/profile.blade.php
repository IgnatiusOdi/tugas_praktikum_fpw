@extends('layouts.user')

@section('title', 'PROFILE')
@section('home', route('dosen-home'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-5xl p-10">Profile Dosen</div>
        <div class="card w-1/2 bg-secondary">
            <figure><img src="https://placeimg.com/400/225/arch" alt="Foto Dosen" class="mt-10 rounded" /></figure>
            <div class="card-body">
                <div class="card-title mx-auto">{{ $nama }}</div>
                <div class="card-title mx-auto">{{ $status }}</div>
            </div>
        </div>
    </div>
@endsection
