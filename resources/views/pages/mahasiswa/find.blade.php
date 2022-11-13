@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    {{-- DOSEN --}}
    <div class="font-bold">{{ $result->dosen_nama }}</div>
    <div class="font-bold">{{ $result->dosen_email }}</div>
    <div class="font-bold">{{ $result->dosen_telepon }}</div>

    {{-- MAHASISWA --}}
    <div class="font-bold">{{ $result->mahasiswa_nama }}</div>
    <div class="font-bold">{{ $result->mahasiswa_email }}</div>
    <div class="font-bold">{{ $result->mahasiswa_telepon }}</div>
@endsection
