@include('layout.logo')

<div class="menu-inner-shadow"></div>

<!--Sidebar-->
<ul class="menu-inner py-1">

    <!-- Beranda -->
    <li class="menu-item {{ Request::is('home*') ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="menu-link">
            <i class='menu-icon tf-icons bx bxs-home'></i>
            <div data-i18n="Analytics">Beranda</div>
        </a>
    </li>

    @can('super-user')
        <!-- Pengguna -->
        <li class="menu-item {{ Request::is('user*') ? 'active' : '' }}">
            <a href="{{ route('user.index') }}" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-user'></i>
                <div data-i18n="Analytics">Pengguna</div>
            </a>
        </li>
    @endcan
</ul>
