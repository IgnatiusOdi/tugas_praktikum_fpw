@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">List Kelas</div>
        @if ($periode != '')
            <div class="font-bold text-3xl mb-8">{{ $periode }}</div>
        @endif
        <div class="dropdown dropdown-hover">
            <label tabindex="0" class="btn btn-primary">Periode</label>
            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-secondary rounded-box w-52">
                @foreach (Session::get('listPeriode') as $goToPeriode)
                    <li><a href="{{ '/mahasiswa/kelas/' . $goToPeriode['tahun'] }}">{{ $goToPeriode['tahun'] }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="overflow-x-auto px-8 py-4 w-full">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>Mata Kuliah</th>
                        <th>Hari</th>
                        <th>Jam</th>
                        <th>Periode</th>
                        <th>Dosen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (Session::get('listKelas') as $kelas)
                        @if ($periode == '')
                            {{-- GET AKTIF --}}
                            @foreach (Session::get('periodeAktif') as $aktif)
                                @if ($kelas['periode'] == $aktif)
                                    <tr>
                                        <th>{{ $kelas['matakuliah'] }}</th>
                                        <td>{{ $kelas['hari'] }}</td>
                                        <td>{{ $kelas['jam'] }}</td>
                                        <td>{{ $kelas['periode'] }}</td>
                                        <td>{{ $kelas['dosen'] }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @else
                            {{-- GET PERIODE SAMA --}}
                            @if ($kelas['periode'] == $url)
                                <tr>
                                    <th>{{ $kelas['matakuliah'] }}</th>
                                    <td>{{ $kelas['hari'] }}</td>
                                    <td>{{ $kelas['jam'] }}</td>
                                    <td>{{ $kelas['periode'] }}</td>
                                    <td>{{ $kelas['dosen'] }}</td>
                                </tr>
                            @endif
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center font-bold">Tidak ada kelas saat ini!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
