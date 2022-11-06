@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">List Kelas</div>
        {{-- @if ($periode != '')
            <div class="font-bold text-3xl mb-8">{{ $periode }}</div>
        @endif
        <div class="dropdown dropdown-hover">
            <label tabindex="0" class="btn btn-primary">Periode</label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-secondary rounded-box w-52">
                @foreach (Session::get('listPeriode') as $goToPeriode)
                    <li><a href="{{ '/mahasiswa/kelas/' . $goToPeriode['tahun'] }}">{{ $goToPeriode['tahun'] }}</a></li>
                @endforeach
            </ul>
        </div> --}}
    </div>
    <div class="overflow-x-auto px-8">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Periode</th>
                    <th>Dosen</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $foundKelas = false;
                @endphp
                @forelse ($listKelas as $kelas)
                    <tr>
                        <th>{{ $kelas->kelas->matakuliah->matakuliah_nama }}</th>
                        <td>{{ $kelas->kelas->hari->hari_nama }}</td>
                        <td>{{ $kelas->kelas->jam->jam_nama }}</td>
                        <td>{{ $kelas->kelas->periode->periode_tahun }}</td>
                        <td>{{ $kelas->kelas->dosen->dosen_nama }}</td>
                        <td>
                            <form action="{{ route('mahasiswa-kelas-detail', $kelas->id) }}" method="GET">
                                <button name="detail" value="{{ $kelas->id }}" class="btn btn-info w-2/3">Detail</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center font-bold">Tidak ada kelas yang diambil!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
