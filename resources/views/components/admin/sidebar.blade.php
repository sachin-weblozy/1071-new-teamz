<div class="ec-left-sidebar ec-bg-sidebar">
    <div id="sidebar" class="sidebar ec-sidebar-footer">

        <div class="ec-brand">
            <a href="{{ route('dashboard') }}" title="Vihan">
                <img class="" src="{{ asset('logo.webp') }}" alt="" style="max-width:100%"/>
                {{-- <span class="ec-brand-name text-truncate">Vihan</span> --}}
            </a>
        </div>

        <!-- begin sidebar scrollbar -->
        <div class="ec-navigation" data-simplebar>
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <!-- Dashboard -->
                @role('superadmin|admin')
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <hr>
                </li>
                @endrole

                @role('superadmin|admin|technician')
                <!-- Tickets -->
                @canany(['Ticket Read', 'Ticket Create', 'Ticket Edit', 'Ticket Delete'])
                {{-- <li class="{{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.tickets.index') }}">
                        <i class="mdi mdi-ticket"></i>
                        <span class="nav-text">Tickets</span>
                    </a>
                </li> --}}
                <li class="has-sub {{ request()->routeIs('admin.tickets.*') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-ticket"></i>
                        <span class="nav-text">Tickets</span> <b class="caret"></b>
                    </a>
                    <div class="collapse" style="{{ request()->routeIs('admin.tickets.*') ? 'display:block;' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">

                            <li class="{{ request()->routeIs('admin.tickets.create') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.tickets.create') }}">
                                    <span class="nav-text">Create</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.tickets.new') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.tickets.new') }}">
                                    <span class="nav-text">New Tickets</span>@if(Helper::admin_new_ticket_count())<span class="badge bg-danger">{{ Helper::admin_new_ticket_count() ?? '' }}</span>@endif
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.tickets.inprogress') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.tickets.inprogress') }}">
                                    <span class="nav-text">InProgress Tickets</span>@if(Helper::admin_inprogress_ticket_count())<span class="badge bg-danger">{{ Helper::admin_inprogress_ticket_count() ?? '' }}</span>@endif
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.tickets.solved') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.tickets.solved') }}">
                                    <span class="nav-text">Solved Tickets</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('admin.tickets.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.tickets.index') }}">
                                    <span class="nav-text">All Tickets</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcanany
                
                <!-- Users -->
                @canany(['User Read', 'User Create', 'User Edit', 'User Delete'])
                {{-- <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.users.index') }}">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">Users</span>
                    </a>
                </li> --}}

                <li class="has-sub {{ request()->routeIs('admin.users.*') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-account-group"></i>
                        <span class="nav-text">Users</span> <b class="caret"></b>
                    </a>
                    <div class="collapse" style="{{ request()->routeIs('admin.users.*') ? 'display:block;' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">

                            <li class="{{ request()->routeIs('admin.users.userslist') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.users.userslist') }}">
                                    <span class="nav-text">Users/Vendors</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.users.technicianlist') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.users.technicianlist') }}">
                                    <span class="nav-text">Technicians</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.users.index') }}">
                                    <span class="nav-text">All Users</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcanany

                <!-- Permissions -->
                {{-- @canany(['Permission Read', 'Permission Create', 'Permission Edit', 'Permission Delete'])
                <li class="{{ request()->routeIs('admin.permissions.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.permissions.index') }}">
                        <i class="mdi mdi-folder-star"></i>
                        <span class="nav-text">Permissions</span>
                    </a>
                </li>
                @endcanany --}}

                <!-- Role -->
                @canany(['Role Read', 'Role Create', 'Role Edit', 'Role Delete'])
                <li class="{{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.roles.index') }}">
                        <i class="mdi mdi-star"></i>
                        <span class="nav-text">Roles</span>
                    </a>
                </li>
                @endcanany

                <!-- Category -->
                @canany(['Category Read', 'Category Create', 'Category Edit', 'Category Delete'])
                <li class="has-sub {{ request()->routeIs('admin.issuetypes.*') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-dns-outline"></i>
                        <span class="nav-text">Category</span> <b class="caret"></b>
                    </a>
                    <div class="collapse" style="{{ request()->routeIs('admin.issue-types.*') ? 'display:block;' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="{{ request()->routeIs('admin.issue-types.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.issue-types.index') }}">
                                    <span class="nav-text">Issue Types</span>
                                </a>
                            </li>

                            {{-- <li class="{{ request()->routeIs('admin.tickets.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.tickets.index') }}">
                                    <span class="nav-text">All Tickets</span>
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                </li>
                @endcanany

                <!-- FAQ -->
                @canany(['FAQ Read', 'FAQ Create', 'FAQ Edit', 'FAQ Delete'])
                <li class="has-sub {{ request()->routeIs('admin.faqs.*') ? 'active expand' : '' }}{{ request()->routeIs('admin.faq-categories.*') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-comment-question"></i>
                        <span class="nav-text">FAQs</span> <b class="caret"></b>
                    </a>
                    <div class="collapse" style="{{ request()->routeIs('admin.faqs.*') ? 'display:block;' : '' }}{{ request()->routeIs('admin.faq-categories.*') ? 'display:block;' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="{{ request()->routeIs('admin.faq-categories.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.faq-categories.index') }}">
                                    <span class="nav-text">FAQ Category</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('admin.faqs.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('admin.faqs.index') }}">
                                    <span class="nav-text">FAQs</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- <li class="{{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.faqs.index') }}">
                        <i class="mdi mdi-comment-question"></i>
                        <span class="nav-text">FAQs</span>
                    </a>
                </li> --}}
                @endcanany

                @canany(['File Read', 'File Create', 'File Edit', 'File Delete'])
                <li class="{{ request()->routeIs('admin.files.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.files.index') }}">
                        <i class="mdi mdi-washing-machine"></i>
                        <span class="nav-text">Manage Files</span>
                    </a>
                </li>
                @endcanany

                {{-- @canany(['Video Read', 'Video Create', 'Video Edit', 'Video Delete'])
                <li class="{{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.videos.index') }}">
                        <i class="mdi mdi-video"></i>
                        <span class="nav-text">Machine Videos</span>
                    </a>
                </li>
                @endcanany --}}
                @endrole

                @role('superadmin')
                <li class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('admin.reports.index') }}">
                        <i class="mdi mdi-library-books"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </li>
                @endrole

                {{-- for users only  --}}
                @role('user')
                <li class="{{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('user.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                    <hr>
                </li>

                @canany(['Ticket Read', 'Ticket Create', 'Ticket Edit', 'Ticket Delete'])
                {{-- <li class="{{ request()->routeIs('user.tickets.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('user.tickets.index') }}">
                        <i class="mdi mdi-ticket"></i>
                        <span class="nav-text">Tickets</span>
                    </a>
                </li> --}}

                <li class="has-sub {{ request()->routeIs('user.tickets.*') ? 'active expand' : '' }}">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-ticket"></i>
                        <span class="nav-text">Tickets</span> <b class="caret"></b>
                    </a>
                    <div class="collapse" style="{{ request()->routeIs('user.tickets.*') ? 'display:block;' : '' }}">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="{{ request()->routeIs('user.tickets.create') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('user.tickets.create') }}">
                                    <span class="nav-text">Create New</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('user.tickets.unsolved') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('user.tickets.unsolved') }}">
                                    <span class="nav-text">Unsolved Tickets</span>
                                </a>
                            </li>

                            <li class="{{ request()->routeIs('user.tickets.solved') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('user.tickets.solved') }}">
                                    <span class="nav-text">Solved Tickets</span>
                                </a>
                            </li>
                            <li class="{{ request()->routeIs('user.tickets.index') ? 'active' : '' }}">
                                <a class="sidenav-item-link" href="{{ route('user.tickets.index') }}">
                                    <span class="nav-text">All Tickets</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @endcanany

                <hr>

                <li class="{{ request()->routeIs('user.reports.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('user.reports.index') }}">
                        <i class="mdi mdi-library-books"></i>
                        <span class="nav-text">Reports</span>
                    </a>
                </li>

                <!-- FAQ -->
                @canany(['FAQ Read'])
                <li class="{{ request()->routeIs('user.faqs.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('user.faqs.index') }}">
                        <i class="mdi mdi-comment-question"></i>
                        <span class="nav-text">FAQs</span>
                    </a>
                </li>
                @endcanany

                @canany(['File Read'])
                <li class="{{ request()->routeIs('user.files.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('user.files.index') }}">
                        <i class="mdi mdi-washing-machine"></i>
                        <span class="nav-text">Machine Manual</span>
                    </a>
                </li>
                @endcanany

                <li class="{{ request()->routeIs('user.videos.*') ? 'active' : '' }}">
                    <a class="sidenav-item-link" href="{{ route('user.videos.index') }}">
                        <i class="mdi mdi-video"></i>
                        <span class="nav-text">Machine Videos</span>
                    </a>
                </li>

                <li class="#">
                    <a class="sidenav-item-link" href="#">
                        <i class="mdi mdi-account"></i>
                        <span class="nav-text">Profile</span>
                    </a>
                </li>
                <li class="#">
                    <a class="sidenav-item-link" href="#">
                        <i class="mdi mdi-logout"></i>
                        <span class="nav-text">Logout</span>
                    </a>
                </li>
                @endrole

                <!-- Vendors -->
                {{-- <li class="has-sub">
                    <a class="sidenav-item-link" href="javascript:void(0)">
                        <i class="mdi mdi-account-group-outline"></i>
                        <span class="nav-text">Vendors</span> <b class="caret"></b>
                    </a>
                    <div class="collapse">
                        <ul class="sub-menu" id="vendors" data-parent="#sidebar-menu">
                            <li class="">
                                <a class="sidenav-item-link" href="vendor-card.html">
                                    <span class="nav-text">Vendor Grid</span>
                                </a>
                            </li>

                            <li class="">
                                <a class="sidenav-item-link" href="vendor-list.html">
                                    <span class="nav-text">Vendor List</span>
                                </a>
                            </li>
                            <li class="">
                                <a class="sidenav-item-link" href="vendor-profile.html">
                                    <span class="nav-text">Vendors Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                
            </ul>
        </div>
    </div>
</div>