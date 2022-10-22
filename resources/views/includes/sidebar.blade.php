<div class="sticky top-0 bg-secondary-focus h-screen">
    <div class="font-bold text-3xl ml-4 my-8">ADMIN</div>
    <ul class="menu bg-secondary-focus w-56">
        <li class="hover-bordered">
            @if (request()->is('admin'))
                <a class="active" href="{{ route('admin') }}">Dashboard</a>
            @else
                <a href="{{ route('admin') }}">Dashboard</a>
            @endif
        </li>
        <li class="hover-bordered">
            @if (request()->is('admin/matakuliah'))
                <a class="active" href="{{ route('admin-matakuliah') }}">Mata Kuliah</a>
            @else
                <a href="{{ route('admin-matakuliah') }}">Mata Kuliah</a>
            @endif
        </li>
        </li>
        <li class="hover-bordered">
            @if (request()->is('admin/periode'))
                <a class="active" href="{{ route('admin-periode') }}">Periode</a>
            @else
                <a href="{{ route('admin-periode') }}">Periode</a>
            @endif
        </li>
        </li>
        <li class="hover-bordered">
            @if (request()->is('admin/kelas'))
                <a class="active" href="{{ route('admin-kelas') }}">Kelas</a>
            @else
                <a href="{{ route('admin-kelas') }}">Kelas</a>
            @endif
        </li>
        {{-- <li class="hover-bordered">
            @if (request()->is('admin/dosen'))
                <a class="active" href="{{ route('admin-dosen') }}">List Dosen</a>
            @else
                <a href="{{ route('admin-dosen') }}">List Dosen</a>
            @endif
        </li>
        <li class="hover-bordered">
            @if (request()->is('admin/mahasiswa'))
                <a class="active" href="{{ route('admin-mahasiswa') }}">List Mahasiswa</a>
            @else
                <a href="{{ route('admin-mahasiswa') }}">List Mahasiswa</a>
            @endif
        </li> --}}
        <div class="w-full mt-8 text-center">
            <form action="{{ route('admin-logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline btn-error">
                    Logout
                </button>
            </form>
        </div>
    </ul>
</div>
