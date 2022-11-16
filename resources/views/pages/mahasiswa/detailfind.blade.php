@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="text-3xl font-bold text-center">Detail Pencarian</div>
    @if ($result->dosen_username != null)
        {{-- DOSEN --}}
        <div>Username : {{ $result->dosen_username }}</div>
        <div>Nama : {{ $result->dosen_nama }}</div>
        <div>Email : {{ $result->dosen_email }}</div>
        <div>Telepon : {{ $result->dosen_telepon }}</div>
        <div>Tanggal Lahir : {{ $result->dosen_tanggal_lahir }}</div>
        <div>Jurusan : {{ $result->jurusan->jurusan_nama }}</div>
        <div>Tahun Kelulusan : {{ $result->dosen_kelulusan }}</div>
        <div>Password : {{ $result->dosen_password }}</div>
    @else
        {{-- MAHASISWA --}}
        <div>NRP : {{ $result->mahasiswa_nrp }}</div>
        <div>Nama : {{ $result->mahasiswa_nama }}</div>
        <div>Email : {{ $result->mahasiswa_email }}</div>
        <div>Telepon : {{ $result->mahasiswa_telepon }}</div>
        <div>Tanggal Lahir : {{ $result->mahasiswa_tanggal_lahir }}</div>
        <div>Jurusan : {{ $result->jurusan->jurusan_nama }}</div>
        <div>Tahun Kelulusan : {{ $result->mahasiswa_angkatan }}</div>
        <div>Password : {{ $result->mahasiswa_password }}</div>
    @endif
@endsection
