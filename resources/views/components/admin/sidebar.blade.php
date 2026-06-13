<div class="app-overlay"></div>

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo mb-2">
        <a href="{{ route('dashboard') }}" class="app-brand-link d-flex align-items-center text-decoration-none">
            <div class="logo w-100 ">
                    <a href="/">
                        <img src="{{ asset('assets/img/logo/Logo Full Megastore.png') }}" alt="Logo"
                            class=" w-100 object-contain" style="height: auto">
                    </a>
                </div>
        </a>

        <a href="#" class="layout-menu-toggle menu-link text-large ms-auto d-none d-xl-none"
            data-bs-toggle="sidebar" data-target="#layout-menu" data-overlay="true">
        </a>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var overlay = document.querySelector('.app-overlay');
                var closeBtn = document.querySelector('.layout-menu-toggle[data-bs-toggle="sidebar"]');
                if (overlay && closeBtn) {
                    overlay.addEventListener('click', function() {
                        closeBtn.click();
                    });
                }
            });
        </script>
    </div>

    <div class="menu-inner">
        <ul class="menu-inner py-1 grow">

            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}" class="menu-link text-decoration-none">
                    <i class="menu-icon tf-icons bi bi-speedometer2"></i>
                    <div>Dashboard</div>
                </a>
            </li>

            <!-- Master Data -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Master Data</span>
            </li>

            <!-- User -->
            <li class="menu-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                <a href="{{ route('users.index') }}" class="menu-link text-decoration-none">
                    <i class="menu-icon tf-icons bi bi-people"></i>
                    <div>Data Pengguna</div>
                </a>
            </li>
            <!-- Produk -->
            <li class="menu-item {{ request()->routeIs('produk.*') ? 'active' : '' }}">
                <a href="{{ route('produk.index') }}" class="menu-link text-decoration-none">
                    <i class="menu-icon tf-icons bi bi-box-seam"></i>
                    <div>Data Produk</div>
                </a>
            </li>
            <!-- Pelanggan -->
            <li class="menu-item {{ request()->routeIs('pelanggan.*') ? 'active' : '' }}">
                <a href="{{ route('pelanggan.index') }}" class="menu-link text-decoration-none">
                    <i class="menu-icon tf-icons bi bi-person-check"></i>
                    <div>Data Pelanggan</div>
                </a>
            </li>

            <!-- Transaksi -->
            <li class="menu-header small text-uppercase">
                <span class="menu-header-text">Transaksi</span>
            </li>
            <!-- Penjualan -->
            <li class="menu-item {{ request()->routeIs('penjualan.*') ? 'active' : '' }}">
                <a href="{{ route('penjualan.index') }}" class="menu-link text-decoration-none">
                    <i class="menu-icon tf-icons bi bi-receipt"></i>
                    <div>Penjualan</div>
                </a>
            </li>
          

        </ul>
    </div>
</aside>