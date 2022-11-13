@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="font-bold text-5xl p-10">Welcome, {{ $dosen->dosen_nama }}!</div>
@endsection
