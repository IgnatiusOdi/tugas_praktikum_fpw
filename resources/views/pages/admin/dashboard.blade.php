@extends('layouts.admin')

@section('title', 'DASHBOARD')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl p-10">Welcome, Admin!</div>
        <div class="font-bold text-3xl p-10">Progress saat ini :</div>
        <div class="radial-progress text-primary border-4 border-primary mx-10"
            style="--value:99.99; --size:14rem; --thickness: 1rem;">99.99%</div>

        {{-- LIST DOSEN --}}
        <div class="overflow-x-auto">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>Nama Dosen</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listDosen as $dosen)
                        <tr>
                            <td>{{ $dosen->dosen_nama }}</td>
                            <form action="{{ route('admin-ban-dosen', $dosen->id) }}" method="post">
                                @csrf
                                @if ($dosen->deleted_at == null)
                                    <td>Aktif</td>
                                    <td><button class="btn btn-error">BAN</button></td>
                                @else
                                    <td>Banned</td>
                                    <td><button class="btn btn-success">UNBAN</button></td>
                                @endif
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- LIST MAHASISWA --}}
        <div class="overflow-x-auto">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listMahasiswa as $mahasiswa)
                        <tr>
                            <td>{{ $mahasiswa->mahasiswa_nama }}</td>
                            <form action="{{ route('admin-ban-mahasiswa', $mahasiswa->id) }}" method="post">
                                @csrf
                                @if ($mahasiswa->deleted_at == null)
                                    <td>Aktif</td>
                                    <td><button class="btn btn-error">BAN</button></td>
                                @else
                                    <td>Banned</td>
                                    <td><button class="btn btn-success">UNBAN</button></td>
                                @endif
                            </form>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
