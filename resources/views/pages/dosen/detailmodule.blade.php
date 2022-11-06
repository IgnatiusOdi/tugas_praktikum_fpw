@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('dosen'))
@section('kelas', route('dosen-kelas'))
@section('profile', route('dosen-profile'))

@section('content')
    <div class="flex flex-col items-center">
        <div class="font-bold text-3xl p-8">Detail Module</div>
    </div>
    <div class="px-8">
        <div>Nama : {{ $module->module_nama }}</div>
        <div>Keterangan : {{ $module->module_keterangan }}</div>
        <div>Jenis : {{ $module->module_jenis }}</div>
        <div>Deadline : {{ $module->module_deadline }}</div>
        <div>Status :
            @if ($module->module_status == 1)
                Aktif
            @else
                Tidak Aktif
            @endif
        </div>
    </div>

    {{-- LIST MAHASISWA --}}
    <div class="overflow-x-auto">
        <table class="table table-compact table-zebra w-full text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NRP</th>
                    <th>Nama</th>
                    <th>Jawaban</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listMahasiswa as $key => $mahasiswa)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $mahasiswa->mahasiswa->mahasiswa_nrp }}</td>
                        <td>{{ $mahasiswa->mahasiswa->mahasiswa_nama }}</td>
                        <td>
                            @php
                                $ada = false;
                            @endphp
                            @foreach ($pengumpulan as $kumpul)
                                @if ($kumpul->mahasiswa_id == $mahasiswa->id)
                                    {{ $kumpul->module_jawaban }}
                                    @php
                                        $ada = true;
                                        break;
                                    @endphp
                                @endif
                            @endforeach
                            @if (!$ada)
                                Belum mengumpulkan
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
