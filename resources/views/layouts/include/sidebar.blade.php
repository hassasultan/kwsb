<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark"
    id="sidenav-main" style="background-color: #202940 !important;">
    <div class="sidenav-header mb-3">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" {{ route('home') }}" target="_blank">
            <img src="{{ asset('assets/img/unnamed.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold text-white">CMP</span>
            <p class="text-white">Complaint Management Portal</p>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white @if (Route::is('home')) active  bg-gradient-primary @endif"
                    href=" {{ route('home') }}">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">dashboard</i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role == 1)
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('user-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/user-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('source-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/source-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Source Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('town-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/town-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Town Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('subtown-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/subtown-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">SubTown Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('agent-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/agent-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Mobile Agent Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('customer-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/customer-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Customers Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('priorities-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/priorities-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Priorities Management</span>
                    </a>
                </li>


                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('compaints-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/compaints-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Complaints Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('compaints-type-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/compaints-type-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">CT Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('subtype-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/subtype-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">SubType Management</span>
                    </a>
                </li>
            @endif
            @if (auth()->user()->role == 2)
                {{-- <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('user-management.index')) active bg-gradient-primary @endif"
                        href="{{ route('user-management.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">User Management</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('source-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/source-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Source Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('town-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('system/town-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Town Management</span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('agent-management.index')) active bg-gradient-primary @endif"
                        href="{{ route('agent-management.index') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Mobile Agent Management</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('customer-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('system/customer-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Customers Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('priorities-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('system/priorities-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Priorities Management</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('compaints-type-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('system/compaints-type-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">CT Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('subtype-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('admin/subtype-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">SubType Management</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white @if (Route::is('compaints-management.index')) active bg-gradient-primary @endif"
                        href="{{ url('system/compaints-management') }}">
                        <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="material-icons opacity-10">receipt_long</i>
                        </div>
                        <span class="nav-link-text ms-1">Complaints Management</span>
                    </a>
                </li>
            @endif

            <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                <form sytle='display:none;' id="logout-form" action="{{ route('logout') }}" method="POST"
                    class="d-none">
                    @csrf
                </form>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            {{-- <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a> --}}
        </div>
    </div>
</aside>
