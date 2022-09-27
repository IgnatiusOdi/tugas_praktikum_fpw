@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa-home'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="font-bold text-5xl p-10">Welcome, {{ $nama }}!</div>
    @if ($status == 'CUTI')
        <div>Mahasiswa sedang mengambil cuti!</div>
    @else
        <div>Hello</div>
    @endif
@endsection
