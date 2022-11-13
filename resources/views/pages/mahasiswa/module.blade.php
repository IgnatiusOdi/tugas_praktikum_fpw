@extends('layouts.user')

@section('title', 'HOME')
@section('home', route('mahasiswa'))
@section('kelas', route('mahasiswa-kelas'))
@section('profile', route('mahasiswa-profile'))

@section('content')
    <div class="font-bold text-3xl p-8">Detail Module</div>
    <div class="ml-6 mr-6">
        <div>Mata Kuliah : {{ $module->kelas->matakuliah->matakuliah_nama }}</div>
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

        @if ($module->module_status == 1)
            <form action="{{ route('mahasiswa-submit-module', $module->id) }}" method="POST">
                @csrf
                Jawaban : <input type="text" name="jawaban" value="{{ old('jawaban') }}">
                @error('jawaban')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
                <button class="btn btn-warning">Submit</button>
            </form>
        @endif

        @php
            $statusPengumpulan = App\Models\MahasiswaModule::where('module_id', $module->id)
                ->where('mahasiswa_id', auth("guard_mahasiswa")->user()->id)
                ->first();
        @endphp
        @if ($statusPengumpulan)
            <div class="alert alert-success shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Sudah Mengumpulkan</span>
                </div>
            </div>
        @else
            <div class="alert alert-error shadow-lg">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Belum Mengumpulkan</span>
                </div>
            </div>
        @endif
    </div>
@endsection
