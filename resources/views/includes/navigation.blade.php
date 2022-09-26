<div class="navbar bg-primary">
    <div class="flex-1">
        <a class="btn btn-ghost normal-case text-xl" href=@yield('home')>iH - class</a>
    </div>
    <div class="flex-none">
        <ul class="menu menu-horizontal p-0">
            <li tabindex="0">
                <a>NAMA</a>
                <ul class="p-2 bg-base-100">
                    <li><a href=@yield('profile')>Profile</a></li>
                    <li><a href="{{ route('login') }}">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
