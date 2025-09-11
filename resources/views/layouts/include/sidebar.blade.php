{{-- new Sidebar Start --}}
<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light mx-n3">
        <!-- nav bar -->
        @can('home')
            <div class="w-100 mb-4 d-flex">
                <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{ URL('admin/home') }}">
                    <span class="avatar avatar-sm mt-2">
                        <img src="{{ asset('assets/images/unnamed.png') }}" class="avatar-img rounded-circle w-50" />
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
        @endcan

        <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
                <a href="#dashboard" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                    <i class="fe fe-home fe-16"></i>
                    <span class="ml-3 item-text">D&R</span><span class="sr-only">(current)</span>
                </a>
                <ul class="collapse list-unstyled w-100 show" id="dashboard">
                    @can('home')
                        <li class="nav-item @if (Route::is('home')) active @endif">
                            <a class="nav-link " href="{{ route('home') }}"><span
                                    class="ml-1 item-text">Dashboard</span></a>
                        </li>
                    @endcan
                    @can('admin.reports')
                        <li class="nav-item @if (Route::is('admin.reports')) active @endif">
                            <a class="nav-link " href="{{ route('admin.reports') }}"><span
                                    class="ml-1 item-text">Reports</span></a>
                        </li>
                    @endcan
                    @can('admin.logs.index')
                        <li class="nav-item @if (Route::is('admin.logs.index')) active @endif">
                            <a class="nav-link " href="{{ route('admin.logs.index') }}"><span
                                    class="ml-1 item-text">Complaint Logs</span></a>
                        </li>
                    @endcan
                    @can('notifications.index')
                        <li class="nav-item @if (Route::is('admin.notification.*')) active @endif">
                            <a class="nav-link " href="{{ route('admin.notification.index') }}"><span
                                    class="ml-1 item-text">Notification Management</span></a>
                        </li>
                    @endcan
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
                    @can('announcements.index')
                        <li class="nav-item @if (Route::is('announcements.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/announcements') }}"><span
                                    class="ml-1 item-text">Announcement</span>
                            </a>
                        </li>
                    @endcan
                    @can('user-management.index')
                        <li class="nav-item @if (Route::is('user-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/user-management') }}"><span class="ml-1 item-text">User
                                    Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('departments.index')
                        <li class="nav-item @if (Route::is('departments.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/departments') }}"><span class="ml-1 item-text">Department
                                    Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('roles.index')
                        <li class="nav-item @if (Route::is('roles.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/roles') }}"><span class="ml-1 item-text">Role
                                    Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('permissions.index')
                        <li class="nav-item @if (Route::is('permissions.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/permissions') }}"><span
                                    class="ml-1 item-text">Permissions Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('source-management.index')
                        <li class="nav-item @if (Route::is('source-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/source-management') }}"><span
                                    class="ml-1 item-text">Source Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('town-management.index')
                        <li class="nav-item @if (Route::is('town-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/town-management') }}"><span class="ml-1 item-text">Town
                                    Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('districts.index')
                        <li class="nav-item @if (Route::is('districts.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/districts') }}"><span class="ml-1 item-text">District
                                    Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('subtown-management.index')
                        <li class="nav-item @if (Route::is('subtown-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/subtown-management') }}"><span
                                    class="ml-1 item-text">SubTown Management</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#forms" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                    <i class="fe fe-layers fe-16"></i>
                    <span class="ml-3 item-text">Agents & Others</span>
                    {{-- <span class="badge badge-pill badge-primary">New</span> --}}
                </a>

                <ul class="collapse list-unstyled w-100 show" id="forms">
                    @can('agent-management.index')
                        <li class="nav-item @if (Route::is('agent-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/agent-management') }}"><span
                                    class="ml-1 item-text">Agents Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('customer-management.index')
                        <li class="nav-item @if (Route::is('customer-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/customer-management') }}"><span
                                    class="ml-1 item-text">Customers Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('priorities-management.index')
                        <li class="nav-item @if (Route::is('priorities-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/priorities-management') }}"><span
                                    class="ml-1 item-text">Priorities Management</span>
                            </a>
                        </li>
                    @endcan

                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#tables" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle nav-link">
                    <i class="fe fe-grid fe-16"></i>
                    <span class="ml-3 item-text">Complaints Management</span>
                </a>
                <ul class="collapse list-unstyled w-100 show" id="tables">
                    @can('compaints-management.index')
                        <li class="nav-item @if (Route::is('compaints-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/compaints-management') }}"><span
                                    class="ml-1 item-text">Complaints</span>
                            </a>
                        </li>
                        <li class="nav-item @if (Route::is('compaints-management.index') && request()->get('comp_type_id')) active @endif">
                            <a class="nav-link" href="{{ url('admin/compaints-management') }}?comp_type_id[]=1&comp_type_id[]=2&comp_type_id[]=5"><span
                                    class="ml-1 item-text">Requests</span>
                            </a>
                        </li>
                    @endcan
                    @can('compaints-type-management.index')
                        <li class="nav-item @if (Route::is('compaints-type-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/compaints-type-management') }}"><span
                                    class="ml-1 item-text">CT Management</span>
                            </a>
                        </li>
                    @endcan
                    @can('subtype-management.index')
                        <li class="nav-item @if (Route::is('subtype-management.index')) active @endif">
                            <a class="nav-link" href="{{ url('admin/subtype-management') }}"><span
                                    class="ml-1 item-text">SubType</span>
                            </a>
                        </li>
                    @endcan
                    @can('bounce-back.index')
                    <li class="nav-item @if (Route::is('bounce-back.index')) active @endif">
                        <a class="nav-link" href="{{ route('bounce-back.index') }}"><span
                                class="ml-1 item-text">Bounce Back Complaints</span>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
        </ul>
    </nav>
</aside>


{{-- new Sidebar End --}}
