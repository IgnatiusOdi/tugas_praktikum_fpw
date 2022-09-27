@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen-home'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="font-bold text-5xl p-10">Welcome, {{ $nama }}!</div>
    @if ($status == 'CUTI')
        <div class="text-bold text-2xl px-10 text-red-500">Dosen sedang mengambil cuti!</div>
    @else
        <div class="text-bold text-2xl px-10">Module Kelas</div>
        <div class="grid grid-cols-5 gap-4 p-4">
            @foreach ($listPelajaran as $pelajaran)
                <div class="card w-full bg-secondary">
                    <figure><img src="https://placeimg.com/400/225/arch" alt="Foto Pelajaran" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $pelajaran }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
