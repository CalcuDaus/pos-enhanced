<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard.index') }}"
                class="b-brand text-primary d-flex align-items-center gap-2"><!-- ========   Change your logo from here   ============ -->
                <img src="{{ asset('img/logo-POS.png') }}" alt="logo image" width="50px" />
                <span style="font-family: poppins;font-weight: 700;font-size: 1.3rem;"class="mt-2">Point Of
                    Sales</span>
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item pc-hasmenu">
                    <a href="#!" class="pc-link"><span class="pc-micon"><i class="ph-duotone ph-gauge"></i>
                        </span><span class="pc-mtext" data-i18n="Dashboard">Dashboard</span>
                        <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        <span class="pc-badge">1</span></a>
                    <ul class="pc-submenu">
                        <li class="pc-item">
                            <a class="pc-link" href="/" data-i18n="Grafik Data">Grafik Data</a>
                        </li>
                    </ul>
                </li>

                <li class="pc-item pc-caption">
                    <label data-i18n="Master Penjualan">Master Penjualan</label>
                    <i class="ph-duotone ph-chart-pie"></i>
                </li>
                <li class="pc-item pc-hasmenu"><a href="#!" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-shopping-cart"></i> </span><span class="pc-mtext"
                            data-i18n="Penjualan">Penjualan</span><span class="pc-arrow"><svg
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-chevron-right">
                                <polyline points="9 18 15 12 9 6"></polyline>
                            </svg></span></a>
                    <ul class="pc-submenu" style="display: block; box-sizing: border-box;">
                        <li class="pc-item"><a class="pc-link" href="#" data-i18n="Uang">Uang</a></li>
                        <li class="pc-item"><a class="pc-link" href="{{ route('sales.index') }}"
                                data-i18n="Barang">Barang</a></li>
                    </ul>
                </li>
                <li class="pc-item">
                    <a href="../widget/w_user.html" class="pc-link"><span class="pc-micon"><i
                                class="ph-duotone ph-hand-coins"></i> </span><span class="pc-mtext"
                            data-i18n="Utang">Utang</span></a>
                </li>

                @if (auth()->user()->role === 'admin')
                    <li class="pc-item pc-caption">
                        <label data-i18n="Master Kelola">Master Kelola</label>
                        <i class="ph-duotone ph-chart-pie"></i>
                    </li>
                    {{-- Produk --}}
                    <li class="pc-item pc-hasmenu"><a href="#!" class="pc-link"><span class="pc-micon"><i
                                    class="ph-duotone ph-wall"></i> </span><span class="pc-mtext"
                                data-i18n="Produk">Produk</span><span class="pc-arrow"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg></span></a>
                        <ul class="pc-submenu" style="display: block; box-sizing: border-box;">
                            <li class="pc-item"><a class="pc-link" href="{{ route('products.index') }}"
                                    data-i18n="Produk">Produk</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('categories.index') }}"
                                    data-i18n="Kategori">Kategori</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('customers.index') }}"
                                    data-i18n="Pelanggan">Pelanggan</a>
                            </li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('inventories.index') }}"
                                    data-i18n="Log Stok">Log Stok</a></li>
                        </ul>
                    </li>
                    {{-- Aplikasi --}}
                    <li class="pc-item pc-hasmenu"><a href="#!" class="pc-link"><span class="pc-micon"><i
                                    class="ph-duotone ph-gear"></i> </span><span class="pc-mtext"
                                data-i18n="Aplikasi">Aplikasi</span><span class="pc-arrow"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-chevron-right">
                                    <polyline points="9 18 15 12 9 6"></polyline>
                                </svg></span></a>
                        <ul class="pc-submenu" style="display: block; box-sizing: border-box;">
                            <li class="pc-item"><a class="pc-link" href="#" data-i18n="Retail">Retail</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('users.index') }}"
                                    data-i18n="Pengguna">Pengguna</a></li>
                            <li class="pc-item"><a class="pc-link" href="{{ route('accounts.index') }}"
                                    data-i18n="Rekening">Rekening</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
            <div class="card nav-action-card bg-brand-color-4">
                <div class="card-body"
                    style="
                                background-image: url('../assets/images/layout/nav-card-bg.svg');
                            ">
                    <h5 class="text-dark">Pusat Bantuan</h5>
                    <p class="text-dark text-opacity-75">
                        Silakan hubungi kami untuk pertanyaan lebih lanjut.
                    </p>
                    <a href="https://instagram.com/e.about.us" class="btn btn-primary" target="_blank">Ke Pusat
                        Bantuan</a>
                </div>
            </div>
        </div>
        <div class="card pc-user-card">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <img src="{{ asset('dist/assets/images/user/avatar-1.jpg') }}" alt="user-image"
                            class="user-avtar wid-45 rounded-circle" />
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="dropdown">
                            <a href="#" class="arrow-none dropdown-toggle" data-bs-toggle="dropdown"
                                aria-expanded="false" data-bs-offset="0,20">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 me-2">
                                        <h6 class="mb-0">{{ Auth::user()->name }}</h6>
                                        <small>{{ Auth::user()->role }}</small>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="btn btn-icon btn-link-secondary avtar">
                                            <i class="ph-duotone ph-windows-logo"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li>
                                        <a class="pc-user-links"><i class="ph-duotone ph-user"></i>
                                            <span>My Account</span></a>
                                    </li>
                                    <li>
                                        <a class="pc-user-links"><i class="ph-duotone ph-gear"></i>
                                            <span>Settings</span></a>
                                    </li>
                                    <li>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button style="border: none;background: transparent;width: 93%;"
                                                type="submit" class="pc-user-links"><i
                                                    class="ph-duotone ph-power"></i>
                                                <span>Logout</span></button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
