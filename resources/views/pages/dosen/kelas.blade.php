@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

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
                    <li><a href="{{ '/dosen/kelas/' . $goToPeriode['tahun'] }}">{{ $goToPeriode['tahun'] }}</a></li>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($listKelas as $kelas)
                    <tr>
                        <th>{{ $kelas->matakuliah_nama }}</th>
                        <td>{{ $kelas->hari_nama }}</td>
                        <td>{{ $kelas->jam_nama }}</td>
                        <td>{{ $kelas->periode_tahun }}</td>
                        <td>
                            <form action="{{ route('dosen-kelas-detail', $kelas->id) }}" method="GET">
                                <button class="btn btn-info w-2/3">Detail</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada kelas saat ini!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
