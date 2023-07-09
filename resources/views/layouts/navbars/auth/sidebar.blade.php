<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl fixed-start bg-gradient-primary"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard.index') }}">
            <img src="{{ asset('assets/img/sidebar-logo.png') }}" class="navbar-brand-img h-100 invert" alt="...">
            <span class="ms-3 font-weight-bold text-white font brand-text">Sipinjam</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @can('administrator')
                <li class="nav-item mt-2">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Administrator</h6>
                </li>
            @endcan
            @can('unitadmin')
                <li class="nav-item mt-2">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Unit Admin</h6>
                </li>
            @endcan
            @can('borrower')
                <li class="nav-item mt-2">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder text-white">Borrower</h6>
                </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i style="font-size: 1rem;"
                            class="fas fa-lg fa-home ps-2 pe-2 text-center text-dark {{ Request::is('dashboard') ? 'text-white' : 'text-dark' }} "
                            aria-hidden="true"></i>
                    </div>
                    <span
                        class="nav-link-text ms-1 {{ Request::is('dashboard') ? 'text-dark' : 'text-white' }}">Dashboard</span>
                </a>
            </li>
            @can('administrator')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="{{ url('categories') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-list-alt ps-2 pe-2 text-center text-dark {{ Request::is('categories') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span
                            class="nav-link-text ms-1 {{ Request::is('categories') ? 'text-dark' : 'text-white' }}">Categories</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('unitadmins') ? 'active' : '' }}" href="{{ url('unitadmins') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-user-cog ps-2 pe-2 text-center text-dark {{ Request::is('unitadmins') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span
                            class="nav-link-text ms-1 {{ Request::is('unitadmins') ? 'text-dark' : 'text-white' }}">Unit
                            Admins</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('units') ? 'active' : '' }}" href="{{ url('units') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-building ps-2 pe-2 text-center text-dark {{ Request::is('units') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span
                            class="nav-link-text ms-1 {{ Request::is('units') ? 'text-dark' : 'text-white' }}">Units</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-user ps-2 pe-2 text-center text-dark {{ Request::is('profile') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1 {{ Request::is('profile') ? 'text-dark' : 'text-white' }}">User
                            Profile</span>
                    </a>
                </li>
            @endcan
            @can('unitadmin')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('bookings') ? 'active' : '' }}" href="{{ url('bookings') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-calendar-alt ps-2 pe-2 text-center text-dark {{ Request::is('bookings') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span
                            class="nav-link-text ms-1 {{ Request::is('bookings') ? 'text-dark' : 'text-white' }}">Bookings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('items') ? 'active' : '' }}" href="{{ url('items') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-cubes ps-2 pe-2 text-center text-dark {{ Request::is('items') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span
                            class="nav-link-text ms-1 {{ Request::is('items') ? 'text-dark' : 'text-white' }}">Items</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('usages') ? 'active' : '' }}" href="{{ url('usages') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-chart-line ps-2 pe-2 text-center text-dark {{ Request::is('usages') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span
                            class="nav-link-text ms-1 {{ Request::is('usages') ? 'text-dark' : 'text-white' }}">Usages</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-user ps-2 pe-2 text-center text-dark {{ Request::is('profile') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1 {{ Request::is('profile') ? 'text-dark' : 'text-white' }}">User
                            Profile</span>
                    </a>
                </li>
            @endcan
            @can('borrower')
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('bookings') ? 'active' : '' }} " href="{{ url('bookings') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-calendar-check ps-2 pe-2 text-center text-dark {{ Request::is('bookings') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span
                            class="nav-link-text ms-1 {{ Request::is('bookings') ? 'text-dark' : 'text-white' }}">Bookings</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('items') ? 'active' : '' }}" href="{{ url('items') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-cubes ps-2 pe-2 text-center text-dark {{ Request::is('items') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1 {{ Request::is('items') ? 'text-dark' : 'text-white' }}">Items
                            Available</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i style="font-size: 1rem;"
                                class="fas fa-lg fa-user ps-2 pe-2 text-center text-dark {{ Request::is('profile') ? 'text-white' : 'text-dark' }} "
                                aria-hidden="true"></i>
                        </div>
                        <span class="nav-link-text ms-1 {{ Request::is('profile') ? 'text-dark' : 'text-white' }}">User
                            Profile</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
    <div class="sidenav-footer m-3">
        <div class="card card-background shadow-none bg-gradient-dark" id="sidenavCard">
            <div class="card-body text-start p-3 w-100">
                <div
                    class="icon icon-shape icon-sm bg-white shadow text-center mb-3 d-flex align-items-center justify-content-center border-radius-md">
                    <i class="fas fa-gem text-dark text-gradient text-lg top-0" aria-hidden="true"
                        id="sidenavCardIcon"></i>
                </div>
                <div class="docs-info">
                    <h6 class="text-white mb-0">Need help?</h6>
                    <p class="text-xs font-weight-bold">Please check our docs</p>
                    <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard"
                        target="_blank" class="btn bg-gradient-light btn-sm w-100 mb-0">Documentation</a>
                </div>
            </div>
        </div>
    </div>
</aside>
