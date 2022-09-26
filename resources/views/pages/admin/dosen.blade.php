@extends('layouts.admin')

@section('title', 'LIST DOSEN')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">List Dosen</div>
        <div class="grid grid-cols-4 gap-4 p-4">
            @foreach ($listDosen as $dosen)
                <div class="card w-full glass">
                    <figure><img src="https://placeimg.com/400/225/arch" alt="Foto Dosen" /></figure>
                    <div class="card-body @if ($dosen['Status'] == 'Cuti') bg-base-300 @endif">
                        <h2 class="card-title">{{ $dosen['Nama Lengkap'] }}</h2>
                        <p>{{ $dosen['Gender'] }}</p>
                        <div class="card-actions justify-end">
                            <div class="badge badge-outline">{{ $dosen['Status'] }}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
