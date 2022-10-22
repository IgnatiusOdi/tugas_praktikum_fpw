@extends('layouts.admin')

@section('title', 'DASHBOARD')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl p-10">Welcome, Admin!</div>
        <div class="font-bold text-3xl p-10">Progress saat ini :</div>
        <div class="radial-progress text-primary border-4 border-primary mx-10"
            style="--value:57.14; --size:14rem; --thickness: 1rem;">57.14%</div>
        {{-- <div class="font-bold text-2xl p-10 bg-primary-focus text-secondary">List Mata Kuliah</div>
        <div class="text-xl p-4">Total mata kuliah yang ada: {{ count(Session::get('listMataKuliah')) }} mata kuliah</div>
        <div class="grid grid-cols-4 gap-4 p-4">
            @forelse (Session::get('listMataKuliah') as $matkul)
                <div class="card w-full glass">
                    <figure><img src="https://placeimg.com/400/225/arch" alt="Foto Pelajaran" /></figure>
                    <div class="card-body">
                        <h2 class="card-title">{{ $matkul }}</h2>
                    </div>
                </div>
            @empty
                <div>Tidak ada mata kuliah saat ini!</div>
            @endforelse
        </div>
        <div class="font-bold text-2xl p-10 bg-primary-focus text-secondary">List Dosen</div>
        <div class="text-xl p-4">Total dosen yang ada: {{ count(Session::get('listDosen')) }} dosen</div>
        <div class="carousel mx-auto w-1/2">
            @forelse (Session::get('listDosen') as $key => $dosen)
                <div id="slide{{ $key }}" class="carousel-item relative w-full">
                    <div class="card w-full bg-primary-content mb-4">
                        <figure><img src="https://placeimg.com/400/225/arch" alt="Foto Dosen" class="mt-4 rounded" />
                        </figure>
                        <div class="card-body px-32">
                            <h2 class="card-title">{{ $dosen['nama'] }}</h2>
                            <p>{{ $dosen['jurusan'] }}</p>
                            <div class="card-actions justify-end">
                                <div class="badge badge-outline">{{ $dosen['nomor'] }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute flex justify-between transform -translate-y-1/2 left-5 right-5 top-1/3">
                        <a href="@if ($key > 0) #slide{{ $key - 1 }} @else #slide{{ count(Session::get('listDosen')) - 1 }} @endif"
                            class="btn btn-circle">❮</a>
                        <a href="@if ($key < count(Session::get('listDosen')) - 1) #slide{{ $key + 1 }} @else #slide0 @endif"
                            class="btn btn-circle">❯</a>
                    </div>
                </div>
            @empty
                <div>Tidak ada doesn saat ini!</div>
            @endforelse
        </div>
        <div class="font-bold text-2xl p-10 bg-primary-focus text-secondary">List Mahasiswa</div>
        <div class="text-xl p-4">Total mahasiswa yang ada: {{ count(Session::get('listMahasiswa')) }} mahasiswa</div>
        <div class="overflow-x-auto px-8 py-4">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>NRP</th>
                        <th>Nama Lengkap</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (Session::get('listMahasiswa') as $mahasiswa)
                        <tr>
                            <th>{{ $mahasiswa['nrp'] }}</th>
                            <td>{{ $mahasiswa['nama'] }}</td>
                            <td>{{ $mahasiswa['password'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">Tidak ada mahasiswa saat ini!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> --}}
    </div>
@endsection
