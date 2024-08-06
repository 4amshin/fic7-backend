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
        <li class="menu-item {{ Request::is('pengguna*') ? 'active' : '' }}">
            <a href="" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-user'></i>
                <div data-i18n="Analytics">Pengguna</div>
            </a>
        </li>
    @endcan
</ul>
