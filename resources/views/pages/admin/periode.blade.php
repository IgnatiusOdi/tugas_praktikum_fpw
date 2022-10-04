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
                {{-- Tahun 2 --}}
                <label class="label">
                    <span class="label-text">Tahun 2</span>
                </label>
                <input type="number" name="tahun2" placeholder="Tahun 2" min="{{ date('Y') }}"
                    max="{{ date('Y') + 10 }}" class="input input-bordered input-primary w-full bg-white"
                    value="{{ date('Y') + 1 }}" />
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
                    @if (Session::has('listPeriode'))
                        @forelse (Session::get('listPeriode') as $periode)
                            <tr>
                                <th>
                                    @php
                                        $p = explode('-', $periode['tahun']);
                                        $p = $p[0] . '/' . $p[1];
                                    @endphp
                                    {{ $p }}
                                </th>
                                <td>{{ $periode['status'] == 0 ? 'Tidak Aktif' : 'Aktif' }}</td>
                                <td>
                                    <form action="{{ route('admin-action-periode') }}" method="POST">
                                        @csrf
                                        <button name="change" value="{{ $periode['status'] }}"
                                            class="btn btn-info w-1/3">Change Status</button>
                                        <button name="delete" value="{{ $periode['tahun'] }}"
                                            class="btn btn-error w-1/3">Delete</button>
                                        <input type="hidden" name="tahun" value="{{ $periode['tahun'] }}">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center font-bold">Tidak ada periode saat ini!</td>
                            </tr>
                        @endforelse
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
