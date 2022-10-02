<div class="sticky top-0 bg-secondary-focus h-screen">
    <div class="font-bold text-3xl ml-4 my-8">ADMIN</div>
    <ul class="menu bg-secondary-focus w-56">
        <li class="hover-bordered">
            @if (request()->is('admin'))
                <a class="active" href="{{ route('admin-dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('admin-dashboard') }}">Dashboard</a>
            @endif
        </li>
        <li class="hover-bordered">
            @if (request()->is('admin/matakuliah'))
                <a class="active" href="{{ route('admin-matakuliah') }}">List Mata Kuliah</a>
            @else
                <a href="{{ route('admin-matakuliah') }}">List Mata Kuliah</a>
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
            <a href="{{ route('login') }}">
                <button class="btn btn-outline btn-error">
                    Logout
                </button>
            </a>
        </div>
    </ul>
</div>
