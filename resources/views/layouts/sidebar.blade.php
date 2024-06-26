<aside class="side-mini-panel with-vertical">
    <!-- ---------------------------------- -->
    <!-- Start Vertical Layout Sidebar -->
    <!-- ---------------------------------- -->
    <div class="iconbar">
      <div>
        <div class="mini-nav">
          <div class="brand-logo d-flex align-items-center justify-content-center">
            <a class="nav-link sidebartoggler" id="headerCollapse" href="javascript:void(0)">
              <iconify-icon icon="solar:hamburger-menu-line-duotone" class="fs-7"></iconify-icon>
            </a>
          </div>
          <ul class="mini-nav-ul" data-simplebar>

            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Dashboards -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.dashboard')   ? 'selected' : '' }}" id="">
              <a href="{{ route('admin.dashboard') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Dashboard">
                <iconify-icon icon="solar:layers-line-duotone" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Dashboard</span>
              </div>
            </li>
            
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Feed -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.feeds.*')   ? 'selected' : '' }}" id="">
              <a href="{{ route('admin.feeds.index') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Feed">
                <iconify-icon icon="solar:feed-linear" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Feed</span>
              </div>
            </li>
            
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Projects -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.projects.*')   ? 'selected' : '' }}" id="">
              <a href="{{ route('admin.projects.index') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Projects">
                <iconify-icon icon="solar:palette-round-line-duotone" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Projects</span>
              </div>
            </li>
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Spaces  -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.spaces.*')   ? 'selected' : '' }}" id="mini-4">
              <a href="javascript:void(0)" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Spaces">
                <iconify-icon icon="solar:widget-6-line-duotone" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Spaces</span>
              </div>
            </li>

            <li>
              <span class="sidebar-divider lg"></span>
            </li>
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Tasks -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.tasks.*')   ? 'selected' : '' }}" id="">
              <a href="{{ route('admin.tasks.index') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Tasks">
                <iconify-icon icon="solar:checklist-minimalistic-line-duotone" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Tasks</span>
              </div>
            </li>
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Calendar -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.calendar')   ? 'selected' : '' }}" id="">
              <a href="{{ route('admin.calendar') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Calendar">
                <iconify-icon icon="solar:calendar-line-duotone" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Calendar</span>
              </div>
            </li>
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Meetings -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.meetings.*')   ? 'selected' : '' }}" id="">
              <a href="{{ route('admin.meetings.index') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Meetings">
                <iconify-icon icon="solar:face-scan-square-broken" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Meetings</span>
              </div>
            </li>
            @canany(['User Read', 'User Create', 'User Edit', 'User Delete'])
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Users -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.users.*') || Route::is('admin.crmuser.list') || Route::is('admin.department.*') || Route::is('admin.teams.*')  ? 'selected' : '' }}" id="mini-5">
              <a href="{{ route('admin.users.index') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Users">
                <iconify-icon icon="solar:users-group-two-rounded-line-duotone" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Users</span>
              </div>
            </li>
            @endcanany
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Notes -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <li class="mini-nav-item {{ Route::is('admin.notes.*')   ? 'selected' : '' }}" id="">
              <a href="{{ route('admin.notes.index') }}" class="mb-0" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Notes">
                <iconify-icon icon="solar:notes-line-duotone" class="fs-7"></iconify-icon>
              </a>
              <div class="fs-1 mt-0 mb-1 w-100 text-center">
                <span >Notes</span>
              </div>
            </li>
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Components -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            {{-- <li class="mini-nav-item" id="mini-8">
              <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Components">
                <iconify-icon icon="solar:archive-line-duotone" class="fs-7"></iconify-icon>
              </a>
            </li>

            <li>
              <span class="sidebar-divider lg"></span>
            </li> --}}
            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Auth -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            {{-- <li class="mini-nav-item" id="mini-9">
              <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Authentication Pages">
                <iconify-icon icon="solar:lock-keyhole-line-duotone" class="fs-7"></iconify-icon>
              </a>
            </li> --}}

            <!-- --------------------------------------------------------------------------------------------------------- -->
            <!-- Multi level -->
            <!-- --------------------------------------------------------------------------------------------------------- -->
            {{-- <li class="mini-nav-item" id="mini-10">
              <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="right" data-bs-title="Docs &amp; Other">
                <iconify-icon icon="solar:mirror-left-line-duotone" class="fs-7"></iconify-icon>
              </a>
            </li>
          </ul> --}}

        </div>
        <div class="sidebarmenu">
          <div class="brand-logo d-flex align-items-center nav-logo">
            <a href="{{ route('admin.dashboard') }}" class="text-nowrap logo-img">
              <img src="{{ asset('logo1.png') }}" alt="Logo" width="200px" />
            </a>

          </div>
          <!-- ---------------------------------- -->
          <!-- Dashboard -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav d-none" id="menu-right-mini-1" data-simplebar>
            <ul class="sidebar-menu" id="sidebarnav">
              <!-- ---------------------------------- -->
              <!-- Home -->
              <!-- ---------------------------------- -->
              <li class="nav-small-cap">
                <span class="hide-menu">Dashboards</span>
              </li>
              <!-- ---------------------------------- -->
              <!-- Dashboard -->
              <!-- ---------------------------------- -->
              <li class="sidebar-item">
                <a class="sidebar-link" href="" id="get-url" aria-expanded="false">
                  <iconify-icon icon="solar:atom-line-duotone"></iconify-icon>
                  <span class="hide-menu">Dashboard 1</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/index2.html" aria-expanded="false">
                  <iconify-icon icon="solar:chart-line-duotone"></iconify-icon>
                  <span class="hide-menu">Dashboard 2</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/index3.html" aria-expanded="false">
                  <iconify-icon icon="solar:screencast-2-line-duotone"></iconify-icon>
                  <span class="hide-menu">Dashboard 3</span>
                </a>
              </li>

              <li>
                <span class="sidebar-divider"></span>
              </li>

              <li class="nav-small-cap">
                <span class="hide-menu">Apps</span>
              </li>

              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <iconify-icon icon="solar:cart-3-line-duotone"></iconify-icon>
                  <span class="hide-menu">Ecommerce</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="../main/eco-shop.html">
                      <span class="icon-small"></span> Shop
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="../main/eco-shop-detail.html">
                      <span class="icon-small"></span>Details
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="../main/eco-product-list.html">
                      <span class="icon-small"></span>List
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="../main/eco-checkout.html">
                      <span class="icon-small"></span>Checkout
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                  <iconify-icon icon="solar:widget-4-line-duotone"></iconify-icon>
                  <span class="hide-menu">Blog</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="../main/blog-posts.html">
                      <span class="icon-small"></span>Blog
                      Posts
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link" href="../main/blog-detail.html">
                      <span class="icon-small"></span>Blog
                      Details
                    </a>
                  </li>
                </ul>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/page-user-profile.html" aria-expanded="false">
                  <iconify-icon icon="solar:shield-user-line-duotone"></iconify-icon>
                  User Profile
                </a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-email.html"><iconify-icon icon="solar:letter-line-duotone"></iconify-icon>Email</a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-calendar.html"><iconify-icon icon="solar:calendar-mark-line-duotone"></iconify-icon>Calendar</a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-kanban.html"><iconify-icon icon="solar:airbuds-case-minimalistic-line-duotone"></iconify-icon>Kanban</a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-chat.html"><iconify-icon icon="solar:chat-round-line-line-duotone"></iconify-icon>Chat</a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-notes.html"><iconify-icon icon="solar:document-text-line-duotone"></iconify-icon>Notes</a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-contact.html"><iconify-icon icon="solar:iphone-line-duotone"></iconify-icon>Contact Table</a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-contact2.html"><iconify-icon icon="solar:phone-line-duotone"></iconify-icon>Contact List</a>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link" href="../main/app-invoice.html"><iconify-icon icon="solar:bill-list-line-duotone"></iconify-icon>Invoice</a>
              </li>
            </ul>
          </nav>

          <!-- ---------------------------------- -->
          <!-- Spaces -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-3" data-simplebar>
            {{-- <livewire:sidebar-spaces /> --}}
          </nav>

          <!-- ---------------------------------- -->
          <!-- Forms -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar {{ Route::is('admin.spaces.*')   ? 'd-block simplebar-scrollable-y' : '' }}" id="menu-right-mini-4" data-simplebar>
            <livewire:sidebar-spaces />
          </nav>

          <!-- ---------------------------------- -->
          <!-- Tables -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar {{ Route::is('admin.users.*') || Route::is('admin.department.*') || Route::is('admin.crmuser.list') || Route::is('admin.teams.*')   ? 'd-block simplebar-scrollable-y' : '' }}" id="menu-right-mini-5" data-simplebar>
            <ul class="sidebar-menu" id="sidebarnav">
              <!-- ---------------------------------- -->
              <!-- Home -->
              <!-- ---------------------------------- -->
              <li class="nav-small-cap">
                <span class="hide-menu">Manage Users</span>
              </li>
              <!-- ---------------------------------- -->
              <!-- Dashboard -->
              <!-- ---------------------------------- -->

              <li class="sidebar-item">
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ Route::is('admin.users.*') || Route::is('admin.crmuser.list') ? 'active' : '' }}">
                  <iconify-icon icon="solar:tablet-line-duotone"></iconify-icon>
                  <span class="hide-menu">All Users</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="{{ route('admin.department.index') }}" class="sidebar-link {{ Route::is('admin.department.*') ? 'active' : '' }}">
                  <iconify-icon icon="solar:tablet-line-duotone"></iconify-icon>
                  <span class="hide-menu">Departments</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="{{ route('admin.teams.index') }}" class="sidebar-link {{ Route::is('admin.teams.*') ? 'active' : '' }}">
                  <iconify-icon icon="solar:tablet-line-duotone"></iconify-icon>
                  <span class="hide-menu">Teams</span>
                </a>
              </li>
              
            </ul>
          </nav>

          <!-- ---------------------------------- -->
          <!-- Charts -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-6" data-simplebar>
            {{-- <ul class="sidebar-menu" id="sidebarnav">
              <!-- ---------------------------------- -->
              <!-- Home -->
              <!-- ---------------------------------- -->
              <li class="nav-small-cap">
                <span class="hide-menu">Charts</span>
              </li>
              <!-- ---------------------------------- -->
              <!-- Dashboard -->
              <!-- ---------------------------------- -->

              <li class="sidebar-item">
                <a href="../main/chart-apex-line.html" class="sidebar-link">
                  <iconify-icon icon="solar:chart-square-line-duotone"></iconify-icon>
                  <span class="hide-menu">Line Chart</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="../main/chart-apex-area.html" class="sidebar-link">
                  <iconify-icon icon="solar:pie-chart-3-line-duotone"></iconify-icon>
                  <span class="hide-menu">Area Chart</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="../main/chart-apex-bar.html" class="sidebar-link">
                  <iconify-icon icon="solar:chart-2-line-duotone"></iconify-icon>
                  <span class="hide-menu">Bar Chart</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="../main/chart-apex-pie.html" class="sidebar-link">
                  <iconify-icon icon="solar:pie-chart-line-duotone"></iconify-icon>
                  <span class="hide-menu">Pie Chart</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="../main/chart-apex-radial.html" class="sidebar-link">
                  <iconify-icon icon="solar:chart-square-line-duotone"></iconify-icon>
                  <span class="hide-menu">Radial Chart</span>
                </a>
              </li>

              <li class="sidebar-item">
                <a href="../main/chart-apex-radar.html" class="sidebar-link">
                  <iconify-icon icon="solar:round-graph-line-duotone"></iconify-icon>
                  <span class="hide-menu">Radar Chart</span>
                </a>
              </li>
            </ul> --}}
          </nav>

          <!-- ---------------------------------- -->
          <!-- Ui Components -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-7" data-simplebar>
            {{-- <ul class="sidebar-menu" id="sidebarnav">
              <!-- ---------------------------------- -->
              <!-- Home -->
              <!-- ---------------------------------- -->
              <li class="nav-small-cap">
                <span class="hide-menu">Ui</span>
              </li>
              <!-- ---------------------------------- -->
              <!-- Dashboard -->
              <!-- ---------------------------------- -->

              <li class="sidebar-item">
                <a href="../main/ui-accordian.html" class="sidebar-link">
                  <iconify-icon icon="solar:waterdrops-line-duotone"></iconify-icon>
                  <span class="hide-menu">Accordian</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-badge.html" class="sidebar-link">
                  <iconify-icon icon="solar:tag-horizontal-line-duotone"></iconify-icon>
                  <span class="hide-menu">Badge</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-buttons.html" class="sidebar-link">
                  <iconify-icon icon="solar:airbuds-case-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Buttons</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-dropdowns.html" class="sidebar-link">
                  <iconify-icon icon="solar:airbuds-case-line-duotone"></iconify-icon>
                  <span class="hide-menu">Dropdowns</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-modals.html" class="sidebar-link">
                  <iconify-icon icon="solar:bolt-line-duotone"></iconify-icon>
                  <span class="hide-menu">Modals</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-tab.html" class="sidebar-link">
                  <iconify-icon icon="solar:box-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Tab</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-tooltip-popover.html" class="sidebar-link">
                  <iconify-icon icon="solar:feed-line-duotone"></iconify-icon>
                  <span class="hide-menu">Tooltip & Popover</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-notification.html" class="sidebar-link">
                  <iconify-icon icon="solar:flag-line-duotone"></iconify-icon>
                  <span class="hide-menu">Notification</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-progressbar.html" class="sidebar-link">
                  <iconify-icon icon="solar:programming-line-duotone"></iconify-icon>
                  <span class="hide-menu">Progressbar</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-pagination.html" class="sidebar-link">
                  <iconify-icon icon="solar:waterdrops-line-duotone"></iconify-icon>
                  <span class="hide-menu">Pagination</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-typography.html" class="sidebar-link">
                  <iconify-icon icon="solar:text-bold-duotone"></iconify-icon>
                  <span class="hide-menu">Typography</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-bootstrap-ui.html" class="sidebar-link">
                  <iconify-icon icon="solar:balloon-line-duotone"></iconify-icon>
                  <span class="hide-menu">Bootstrap UI</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-breadcrumb.html" class="sidebar-link">
                  <iconify-icon icon="solar:slider-minimalistic-horizontal-line-duotone"></iconify-icon>
                  <span class="hide-menu">Breadcrumb</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-offcanvas.html" class="sidebar-link">
                  <iconify-icon icon="solar:laptop-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Offcanvas</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-lists.html" class="sidebar-link">
                  <iconify-icon icon="solar:checklist-bold-duotone"></iconify-icon>
                  <span class="hide-menu">Lists</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-grid.html" class="sidebar-link">
                  <iconify-icon icon="solar:layers-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Grid</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-carousel.html" class="sidebar-link">
                  <iconify-icon icon="solar:align-horizonta-spacing-line-duotone"></iconify-icon>
                  <span class="hide-menu">Carousel</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-scrollspy.html" class="sidebar-link">
                  <iconify-icon icon="solar:multiple-forward-right-line-duotone"></iconify-icon>
                  <span class="hide-menu">Scrollspy</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-spinner.html" class="sidebar-link">
                  <iconify-icon icon="solar:soundwave-bold-duotone"></iconify-icon>
                  <span class="hide-menu">Spinner</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-link.html" class="sidebar-link">
                  <iconify-icon icon="solar:link-round-angle-bold-duotone"></iconify-icon>
                  <span class="hide-menu">Link</span>
                </a>
              </li>
            </ul> --}}
          </nav>

          <!-- ---------------------------------- -->
          <!-- Comoponents -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-8" data-simplebar>
            <ul class="sidebar-menu" id="sidebarnav">
              <!-- ---------------------------------- -->
              <!-- Home -->
              <!-- ---------------------------------- -->
              <li class="nav-small-cap">
                <span class="hide-menu">Components</span>
              </li>
              <!-- ---------------------------------- -->
              <!-- Dashboard -->
              <!-- ---------------------------------- -->
              <li class="sidebar-item">
                <a href="../main/component-sweetalert.html" class="sidebar-link">
                  <iconify-icon icon="solar:star-fall-minimalistic-2-line-duotone"></iconify-icon>
                  <span class="hide-menu">Sweet Alert</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/component-nestable.html" class="sidebar-link">
                  <iconify-icon icon="solar:speaker-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Nestable</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/component-noui-slider.html" class="sidebar-link">
                  <iconify-icon icon="solar:watch-square-minimalistic-charge-line-duotone"></iconify-icon>
                  <span class="hide-menu">Noui slider</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/component-rating.html" class="sidebar-link">
                  <iconify-icon icon="solar:stars-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Rating</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/component-toastr.html" class="sidebar-link">
                  <iconify-icon icon="solar:station-minimalistic-bold-duotone"></iconify-icon>
                  <span class="hide-menu">Toastr</span>
                </a>
              </li>
              <li>
                <span class="sidebar-divider lg"></span>
              </li>
              <li class="nav-small-cap">
                <span class="hide-menu">Cards</span>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-cards.html" class="sidebar-link">
                  <iconify-icon icon="solar:bookmark-square-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Basic Cards</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-card-customs.html" class="sidebar-link">
                  <iconify-icon icon="solar:bookmark-square-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Custom Cards</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-card-weather.html" class="sidebar-link">
                  <iconify-icon icon="solar:cloud-snowfall-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Weather Cards</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/ui-card-draggable.html" class="sidebar-link">
                  <iconify-icon icon="solar:password-minimalistic-input-line-duotone"></iconify-icon>
                  <span class="hide-menu">Draggable Cards</span>
                </a>
              </li>
            </ul>
          </nav>

          <!-- ---------------------------------- -->
          <!-- Auth Pages -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-9" data-simplebar>
            <ul class="sidebar-menu" id="sidebarnav">
              <!-- ---------------------------------- -->
              <!-- Home -->
              <!-- ---------------------------------- -->
              <li class="nav-small-cap">
                <span class="hide-menu">Auth</span>
              </li>
              <!-- ---------------------------------- -->
              <!-- Dashboard -->
              <!-- ---------------------------------- -->

              <li class="sidebar-item">
                <a href="../main/authentication-error.html" class="sidebar-link">
                  <iconify-icon icon="solar:bug-minimalistic-line-duotone"></iconify-icon>
                  <span class="hide-menu">Error</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-login.html" class="sidebar-link">
                  <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                  <span class="hide-menu">Side Login</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-login2.html" class="sidebar-link">
                  <iconify-icon icon="solar:login-3-line-duotone"></iconify-icon>
                  <span class="hide-menu">Boxed Login</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-register.html" class="sidebar-link">
                  <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                  <span class="hide-menu">Side Register</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-register2.html" class="sidebar-link">
                  <iconify-icon icon="solar:user-plus-rounded-line-duotone"></iconify-icon>
                  <span class="hide-menu">Boxed Register</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-forgot-password.html" class="sidebar-link">
                  <iconify-icon icon="solar:password-outline"></iconify-icon>
                  <span class="hide-menu">Side Forgot Pwd</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-forgot-password2.html" class="sidebar-link">
                  <iconify-icon icon="solar:password-outline"></iconify-icon>
                  <span class="hide-menu">Boxed Forgot Pwd</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-two-steps.html" class="sidebar-link">
                  <iconify-icon icon="solar:siderbar-line-duotone"></iconify-icon>
                  <span class="hide-menu">Side Two Steps</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-two-steps2.html" class="sidebar-link">
                  <iconify-icon icon="solar:siderbar-line-duotone"></iconify-icon>
                  <span class="hide-menu">Boxed Two Steps</span>
                </a>
              </li>
              <li class="sidebar-item">
                <a href="../main/authentication-maintenance.html" class="sidebar-link">
                  <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                  <span class="hide-menu">Maintenance</span>
                </a>
              </li>

            </ul>
          </nav>

          <!-- ---------------------------------- -->
          <!-- Docs & Other -->
          <!-- ---------------------------------- -->
          <nav class="sidebar-nav scroll-sidebar" id="menu-right-mini-10" data-simplebar>
            <ul class="sidebar-menu" id="sidebarnav">
              <li class="nav-small-cap">
                <span class="hide-menu">Documentation</span>
              </li>
              <li class="sidebar-item">
                <a href="../docs/index.html" class="sidebar-link">
                  <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                  <span class="hide-menu">Getting Started</span>
                </a>
              </li>
              <li>
                <span class="sidebar-divider"></span>
              </li>
              <li class="nav-small-cap">
                <span class="hide-menu">Multi level</span>
              </li>
              <li class="sidebar-item">
                <a class="sidebar-link has-arrow primary-hover-bg" href="javascript:void(0)" aria-expanded="false">
                  <iconify-icon icon="solar:align-left-line-duotone"></iconify-icon>
                  <span class="hide-menu">Menu Level</span>
                </a>
                <ul aria-expanded="false" class="collapse first-level">
                  <li class="sidebar-item">
                    <a href="javascript:void(0)" class="sidebar-link">
                      <span class="icon-small"></span>
                      <span class="hide-menu">Level 1</span>
                    </a>
                  </li>
                  <li class="sidebar-item">
                    <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                      <span class="icon-small"></span>
                      <span class="hide-menu">Level 1.1</span>
                    </a>
                    <ul aria-expanded="false" class="collapse two-level">
                      <li class="sidebar-item">
                        <a href="javascript:void(0)" class="sidebar-link">
                          <span class="icon-small"></span>
                          <span class="hide-menu">Level 2</span>
                        </a>
                      </li>
                      <li class="sidebar-item">
                        <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                          <span class="icon-small"></span>
                          <span class="hide-menu">Level 2.1</span>
                        </a>
                        <ul aria-expanded="false" class="collapse three-level">
                          <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                              <span class="icon-small"></span>
                              <span class="hide-menu">Level 3</span>
                            </a>
                          </li>
                          <li class="sidebar-item">
                            <a href="javascript:void(0)" class="sidebar-link">
                              <span class="icon-small"></span>
                              <span class="hide-menu">Level 3.1</span>
                            </a>
                          </li>
                        </ul>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li>
              <li>
                <span class="sidebar-divider"></span>
              </li>
              <li class="nav-small-cap">
                <span class="hide-menu">More Options</span>
              </li>
              <li class="sidebar-item">
                <div class="sidebar-link">
                  <span class="round-10 rounded-circle d-block bg-primary"></span>
                  <span class="hide-menu">Applications</span>
                </div>
              </li>
              <li class="sidebar-item">
                <div class="sidebar-link">
                  <span class="round-10 rounded-circle d-block bg-secondary"></span>
                  <span class="hide-menu">Form Options</span>
                </div>
              </li>
              <li class="sidebar-item">
                <div class="sidebar-link">
                  <span class="round-10 rounded-circle d-block bg-danger"></span>
                  <span class="hide-menu">Table Variations</span>
                </div>
              </li>
              <li class="sidebar-item">
                <div class="sidebar-link">
                  <span class="round-10 rounded-circle d-block bg-warning"></span>
                  <span class="hide-menu">Charts Selection</span>
                </div>
              </li>
              <li class="sidebar-item">
                <div class="sidebar-link">
                  <span class="round-10 rounded-circle d-block bg-success"></span>
                  <span class="hide-menu">Widgets</span>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
    </div>
  </aside>