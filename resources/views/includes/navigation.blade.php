<div class="navbar @if (request()->is('mahasiswa') || request()->is('mahasiswa/*')) bg-warning @else bg-primary @endif">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost btn-circle">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                </svg>
            </label>
            <ul tabindex="0" class="menu dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href=@yield('kelas')>Kelas</a></li>
                <li><a href=@yield('profile')>Profile</a></li>
            </ul>
        </div>
    </div>
    <div class="navbar-center">
        <a class="btn btn-ghost normal-case text-xl" href=@yield('home')>iH - class</a>
    </div>
    <div class="navbar-end">
        <form action="{{ route('dosen-logout') }}" method="POST">
            @csrf
            <button class="btn btn-outline @if (request()->is('mahasiswa') || request()->is('mahasiswa/*')) btn-info @else btn-error @endif">
                Logout
            </button>
        </form>
    </div>
</div>
