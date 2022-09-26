@extends('layouts.admin')

@section('title', 'DASHBOARD')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl p-10">Welcome, Admin!</div>
        <div class="font-bold text-2xl p-10 bg-primary-focus text-secondary">List Mata Kuliah</div>
        <div class="text-xl p-4">Total mata kuliah yang ada: {{ count($listPelajaran) }} mata kuliah</div>
        <div class="grid grid-cols-4 gap-4 p-4">
            @foreach ($listPelajaran as $pelajaran)
                <div class="card w-full glass">
                    <figure><img src="https://placeimg.com/400/225/arch" alt="Foto Dosen" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $pelajaran }}</h2>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="font-bold text-2xl p-10 bg-primary-focus text-secondary">List Dosen</div>
        <div class="text-xl p-4">Total dosen yang ada: {{ count($listDosen) }} dosen</div>
        <div class="carousel mx-auto w-1/2">
            @foreach ($listDosen as $key => $dosen)
                <div id="slide{{ $key }}" class="carousel-item relative w-full">
                    <div class="card w-full bg-primary-content mb-4">
                        <figure><img src="https://placeimg.com/400/225/arch" alt="Foto Dosen" class="mt-4 rounded"/></figure>
                        <div class="card-body px-32 @if ($dosen['Status'] == 'Cuti') bg-base-300 @endif">
                            <h2 class="card-title">{{ $dosen['Nama Lengkap'] }}</h2>
                            <p>{{ $dosen['Gender'] }}</p>
                            <div class="card-actions justify-end">
                                <div class="badge badge-outline">{{ $dosen['Status'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/3">
                        <a href="@if ($key > 0) #slide{{ $key - 1 }} @else #slide{{ count($listDosen) - 1 }} @endif"
                            class="btn btn-circle">❮</a>
                        <a href="@if ($key < count($listDosen) - 1) #slide{{ $key + 1 }} @else #slide0 @endif"
                            class="btn btn-circle">❯</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="font-bold text-2xl p-10 bg-primary-focus text-secondary">List Mahasiswa</div>
        <div class="text-xl p-4">Total mahasiswa yang ada: {{ count($listMahasiswa) }} mahasiswa</div>
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full mb-h-screen">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama Lengkap</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listMahasiswa as $mahasiswa)
                        <tr class="@if ($mahasiswa['Status'] == 'Cuti') bg-neutral-focus @else hover @endif">
                            <th>{{ $mahasiswa['NIM'] }}</th>
                            <td>{{ $mahasiswa['Nama Lengkap'] }}</td>
                            <td>{{ $mahasiswa['Gender'] }}</td>
                            <td>{{ $mahasiswa['Status'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
