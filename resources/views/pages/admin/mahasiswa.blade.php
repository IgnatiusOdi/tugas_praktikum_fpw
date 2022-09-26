@extends('layouts.admin')

@section('title', 'LIST MAHASISWA')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">List Mahasiswa</div>
        <div class="overflow-x-auto">
            <table class="table table-zebra w-full">
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
