{{-- new Sidebar Start --}}
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light mx-n3">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ URL('system/home') }}">
                <span class="avatar avatar-sm mt-2">
                    <img src="{{ asset('assets/images/unnamed.png') }}" class="avatar-img rounded-circle w-50"/>
                      {{-- <img src="../dist/assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle"> --}}
                  </span>
        {{-- <img src="{{ asset('assets/images/unnamed.png') }}" class="avatar-img rounded-circle w-100"/> --}}

                {{-- <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120"
                    xml:space="preserve">
                    <g>
                        <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                        <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                        <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                    </g>
                </svg> --}}
            </a>
        </div>

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">D&R</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled w-100 show" id="dashboard">
                    <li class="nav-item @if (Route::is('home')) active @endif">
                        <a class="nav-link " href="{{ route('home') }}"><span
                                class="ml-1 item-text">Dashboard</span></a>
                    </li>
                    {{-- <li class="nav-item @if (Route::is('system.reports')) active @endif">
                        <a class="nav-link " href="{{ route('system.reports') }}"><span
                                class="ml-1 item-text">Reports</span></a>
                    </li> --}}
                </ul>
            </li>
        </ul>
        <p class="text-muted nav-heading mt-4 mb-2 pl-4">
            <span>Components</span>
        </p>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#ui-elements" data-toggle="collapse" aria-expanded="tue" class="dropdown-toggle nav-link">
                    <i class="fe fe-box fe-16"></i>
                    <span class="ml-3 item-text">Activities</span>
                </a>
                <ul class="collapse list-unstyled w-100 show" id="ui-elements">
                    <li class="nav-item @if (Route::is('source-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/source-management') }}"><span class="ml-1 item-text">Source Management</span>
                        </a>
                    </li>
                    <li class="nav-item @if (Route::is('town-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/town-management') }}"><span class="ml-1 item-text">Town Management</span>
                        </a>
                    </li>
                    <li class="nav-item @if (Route::is('districts.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/districts') }}"><span class="ml-1 item-text">District Management</span>
                        </a>
                    </li>
                    <li class="nav-item @if (Route::is('subtown-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/subtown-management') }}"><span class="ml-1 item-text">SubTown Management</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#forms" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">Agents & Others</span>
                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                </a>
                <ul class="collapse list-unstyled w-100 show" id="forms">
                    {{-- <li class="nav-item @if (Route::is('agent-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/agent-management') }}"><span class="ml-1 item-text">Agents Management</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item @if (Route::is('customer-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/customer-management') }}"><span class="ml-1 item-text">Customers Management</span>
                        </a>
                    </li> --}}
                    {{-- <li class="nav-item @if (Route::is('priorities-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/priorities-management') }}"><span class="ml-1 item-text">Priorities Management</span>
                        </a>
                    </li> --}}
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#tables" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Complaints Management</span>
                </a>
                <ul class="collapse list-unstyled w-100 show" id="tables">
                    <li class="nav-item @if (Route::is('compaints-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/compaints-management') }}"><span class="ml-1 item-text">Complaints</span>
                        </a>
                    </li>
                    <li class="nav-item @if (Route::is('compaints-type-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/compaints-type-management') }}"><span class="ml-1 item-text">CT Management</span>
                        </a>
                    </li>
                    <li class="nav-item @if (Route::is('subtype-management.index')) active @endif">
                        <a class="nav-link" href="{{ url('system/subtype-management') }}"><span class="ml-1 item-text">SubType</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>


{{-- new Sidebar End --}}
