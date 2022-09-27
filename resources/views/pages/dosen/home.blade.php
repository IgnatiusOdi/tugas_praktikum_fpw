@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen-home'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="font-bold text-5xl p-10">Welcome, {{ $nama }}!</div>
@endsection
