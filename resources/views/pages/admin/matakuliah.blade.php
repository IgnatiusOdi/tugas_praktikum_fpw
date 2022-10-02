@extends('layouts.admin')

@section('title', 'LIST MATA KULIAH')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">List Mata Kuliah</div>
        <div class="overflow-x-auto px-8">
            <table class="table table-zebra w-full">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>Jurusan</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse (Session::get('listMataKuliah') as $matkul)
                        <tr class="hover">
                            <th>{{ $matkul['kode'] }}</th>
                            <td>{{ $matkul['nama'] }}</td>
                            <td>{{ $matkul['jurusan'] }}</td>
                            <td>{{ $matkul['semester'] }}</td>
                        </tr>
                    @empty
                        <div>Mata Kuliah kosong</div>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
