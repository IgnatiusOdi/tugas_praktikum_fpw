@extends('layouts.admin')

@section('title', 'PERIODE')

@section('content')
    <div class="w-full bg-secondary">
        <div class="font-bold text-5xl m-10">Periode</div>
        <div class="flex flex-col items-center">
            <form action="{{ route('admin-tambah-periode') }}" method="POST"
                class="form-control bg-secondary px-16 py-6 w-full lg:w-1/2">
                @csrf
                <div class="text-2xl font-bold text-center mb-4">Tambah Periode</div>

                {{-- Tahun 1 --}}
                <label class="label">
                    <span class="label-text">Tahun 1</span>
                </label>
                <input type="number" name="tahun1" placeholder="Tahun 1" min="{{ date('Y') }}"
                    max="{{ date('Y') + 10 }}" class="input input-bordered input-primary w-full bg-white"
                    value="{{ date('Y') }}" />
                @error('tahun1')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- Tahun 2 --}}
                <label class="label">
                    <span class="label-text">Tahun 2</span>
                </label>
                <input type="number" name="tahun2" placeholder="Tahun 2" min="{{ date('Y') }}"
                    max="{{ date('Y') + 10 }}" class="input input-bordered input-primary w-full bg-white"
                    value="{{ date('Y') + 1 }}" />
                @error('tahun2')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

                {{-- BUTTON --}}
                <button class="btn bg-primary my-6">Tambah</button>
            </form>
        </div>
        <div class="overflow-x-auto px-8">
            <table class="table table-compact table-zebra w-full text-center">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($listPeriode as $periode)
                        <tr>
                            <th>{{ $periode->periode_tahun }}</th>
                            <td>{{ $periode->periode_status == 0 ? 'Tidak Aktif' : 'Aktif' }}</td>
                            <td>
                                <form action="{{ route('admin-action-periode') }}" method="POST">
                                    @csrf
                                    <button name="change" value="{{ $periode->periode_status }}" class="btn btn-info w-1/3">Change
                                        Status</button>
                                    <button name="delete" value="{{ $periode->id }}"
                                        class="btn btn-error w-1/3">Delete</button>
                                    <input type="hidden" name="id" value="{{ $periode->id }}">
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center font-bold">Tidak ada periode saat ini!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
