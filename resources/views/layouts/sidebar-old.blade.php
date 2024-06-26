<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="d-flex flex-row align-center justify-content-center logo-area">
            <a href="{{ route('admin.dashboard') }}" class="nav-link">
                <img src="{{ asset('logo.png') }}" class="navbar-logo" alt="logo">
            </a>
        </div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu {{ (\Request::route()->getName() == 'admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" data-original-title="Dashboard" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-home"></i>
                </a>
            </li>
            @canany(['Project Read', 'Project Create', 'Project Edit', 'Project Delete'])
            <li class="menu {{ Route::is('admin.projects.*')  ? 'active' : '' }}">
                <a href="{{ route('admin.projects.index') }}" id="apps" data-original-title="Projects" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="lab la-medapps"></i>
                </a>
            </li>
            @endcanany
            @canany(['Space Read', 'Space Create', 'Space Edit', 'Space Delete'])
            <li class="menu {{ Route::is('admin.spaces.*')  ? 'active' : '' }}">
                <a href="javascript:void(0);" id="authPages" data-original-title="Spaces" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    {{-- <span class="new-notification"></span> --}}
                    <i class="lab la-elementor"></i>
                </a>
            </li>
            @endcanany
            @canany(['User Read', 'User Create', 'User Edit', 'User Delete'])
            <li class="menu {{ Route::is('admin.users.*') || Route::is('admin.teams.*') || Route::is('admin.crmuser.list') || Route::is('admin.crmuser.import') || Route::is('admin.department.index')  ? 'active' : '' }}">
                <a href="javascript:void(0);" id="otherPages" data-original-title="Users" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-user"></i>
                </a>
            </li>
            @endcanany
            @canany(['Role Read', 'Role Create', 'Role Edit', 'Role Delete'])
            <li class="menu {{ Route::is('admin.permissions.*') || Route::is('admin.roles.*')  ? 'active' : '' }}">
                <a href="javascript:void(0);" id="rolesPermissions" data-original-title="Roles & Permissions" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    {{-- <span class="new-notification"></span> --}}
                    <i class="las la-lock"></i>
                </a>
            </li>
            @endcanany
            {{-- @canany(['Task Read', 'Task Create', 'Task Edit', 'Task Delete']) --}}
            <li class="menu {{ Route::is('admin.notes.*')  ? 'active' : '' }}">
                <a href="{{ route('admin.notes.index') }}" id="notes" data-original-title="Notes" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="lab la-wpforms"></i>
                </a>
            </li>
            {{-- @endcanany --}}
            @canany(['Task Read', 'Task Create', 'Task Edit', 'Task Delete'])
            <li class="menu {{ Route::is('admin.tasks.*')  ? 'active' : '' }}">
                <a href="{{ route('admin.tasks.index') }}" id="tasks" data-original-title="Tasks" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-tasks"></i>
                </a>
            </li>
            @endcanany
            {{-- <li class="menu {{ (\Request::route()->getName() == 'admin.calendar') ? 'active' : '' }}">
                <a href="{{ route('admin.calendar') }}" data-original-title="Calendar" data-placement="right" class="dropdown-toggle bs-tooltip">
                    <i class="lar la-calendar"></i>
                </a>
            </li> --}}
            {{-- <li class="menu {{ (\Request::route()->getName() == 'admin.todos.index') ? 'active' : '' }}">
                <a href="{{ route('admin.todos.index') }}" data-original-title="Todos" data-placement="right" class="dropdown-toggle bs-tooltip">
                    <i class="las la-tasks"></i>
                </a>
            </li> --}}
            {{-- <li class="menu">
                <a href="javascript:void(0);" id="basicUI" data-original-title="Basic UI" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-drafting-compass"></i>
                </a>
            </li>
            <li class="menu">
                <a href="javascript:void(0);" id="uiElements" data-original-title="UI Elements" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="lab la-elementor"></i>
                </a>
            </li>
            <li class="menu">
                <a href="javascript:void(0);" id="forms" data-original-title="Forms" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="lab la-wpforms"></i>
                </a>
            </li>
            <li class="menu">
                <a href="javascript:void(0);" id="maps" data-original-title="Maps" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-globe-americas"></i>
                </a>
            </li>
            <li class="menu">
                <a href="javascript:void(0);" id="charts" data-original-title="Charts" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-chart-pie"></i>
                </a>
            </li>
            <li class="menu">
                <a href="widgets.html" data-original-title="Widgets" data-placement="right" class="dropdown-toggle bs-tooltip">
                    <i class="las la-desktop"></i>
                </a>
            </li>
            <li class="menu">
                <a href="tables.html" data-original-title="Tables" data-placement="right" class="dropdown-toggle bs-tooltip">
                    <i class="las la-border-all"></i>
                </a>
            </li>
            <li class="menu">
                <a href="datatables.html" data-original-title="Data Tables" data-placement="right" class="dropdown-toggle bs-tooltip">
                    <i class="las la-table"></i>
                </a>
            </li>
            <li class="menu">
                <a href="javascript:void(0);" id="starterKit" data-original-title="Starter Kit" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-copy"></i>
                </a>
            </li>
            <li class="menu">
                <a href="javascript:void(0);" id="multiLevel" data-original-title="Multi Level" data-placement="right" class="main-item dropdown-toggle bs-tooltip">
                    <i class="las la-sitemap"></i>
                </a>
            </li>
            <li class="menu">
                <a href="https://neptuneweb.xyz/documentation/index.html" data-original-title="Documentation" data-placement="right" class="dropdown-toggle bs-tooltip">
                    <i class="las la-file-code"></i>
                </a>
            </li> --}}
        </ul>
        
    </nav>
</div>


<div class="sidebar-submenu">
    {{-- <div class="submenu {{ Route::is('admin.projects.*')  ? 'show' : '' }}" id="appsMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Projects</h5>
                <p>Projects List.</p>
            </div>
            <ul class="submenu-list"> 
                <li class="{{ Route::is('admin.projects.*')  ? 'active' : '' }}">
                    <a href="{{ route('admin.projects.index') }}"> All Projects </a>
                </li>
            </ul>
        </div>
    </div> --}}
    <div class="submenu {{ Route::is('admin.spaces.*')  ? 'show' : '' }}" id="authPagesMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Spaces</h5>
                <p>Project Wise Spaces.</p>
            </div>
            <livewire:sidebar-spaces /> 
        </div>
    </div>
    <div class="submenu {{ Route::is('admin.users.*') || Route::is('admin.teams.*') || Route::is('admin.crmuser.list') || Route::is('admin.crmuser.import') || Route::is('admin.department.index')  ? 'show' : '' }}" id="otherPagesMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Users</h5>
                <p>Manage Users.</p>
            </div>
            <ul class="submenu-list"> 
                <li class="{{ (\Request::route()->getName() == 'admin.users.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}"> All Users </a>
                </li>
                <li class="{{ (\Request::route()->getName() == 'admin.department.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.department.index') }}"> Departments </a>
                </li>
                <li class="{{ (\Request::route()->getName() == 'admin.teams.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.teams.index') }}"> Teams </a>
                </li>
                {{-- @role('superadmin')
                <li class="{{ (\Request::route()->getName() == 'admin.department.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.department.index') }}"> Departments </a>
                </li>
                @endrole --}}
            </ul>
        </div>
    </div>
    <div class="submenu {{ Route::is('admin.roles.*') || Route::is('admin.permissions.*')  ? 'show' : '' }}" id="rolesPermissionsMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Roles & Permissions</h5>
                <p>Manage Permissions.</p>
            </div>
            <ul class="submenu-list"> 
                <li class="{{ (\Route::is('admin.roles.*')) ? 'active' : '' }}">
                    <a href="{{ route('admin.roles.index') }}"> Roles </a>
                </li>
                {{-- <li class="{{ (\Request::route()->getName() == 'admin.permissions.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.permissions.index') }}"> Permissions </a>
                </li> --}}
            </ul>
        </div>
    </div>
    {{-- <div class="submenu" id="basicUIMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Basic UI</h5>
                <p>At vero eos et accusamus et iusto odio.</p>
            </div>
            <ul class="submenu-list"> 
                <li>
                    <a href="basic_ui_accordion.html"> Accordions  </a>
                </li>
                <li>
                    <a href="basic_ui_animation.html"> Animation </a>
                </li>
                <li>
                    <a href="basic_ui_cards.html"> Bootstrap Cards </a>
                </li>
                <li>
                    <a href="basic_ui_carousel.html">Carousel</a>
                </li>
                <li>
                    <a href="basic_ui_countdown.html"> Countdown </a>
                </li>
                <li>
                    <a href="basic_ui_counter.html"> Counter </a>
                </li>
                <li>
                    <a href="basic_ui_dragitems.html">Drag Items</a>
                </li>
                <li>
                    <a href="basic_ui_lightbox.html"> Lightbox </a>
                </li>
                <li>
                    <a href="basic_ui_lightbox_side_open.html"> Lightbox Side Open</a>
                </li>
                <li>
                    <a href="basic_ui_list_groups.html"> List Group </a>
                </li>
                <li>
                    <a href="basic_ui_media_object.html"> Media Object </a>
                </li>
                <li>
                    <a href="basic_ui_modals.html"> Modals </a>
                </li> 
                <li>
                    <a href="basic_ui_notifications.html"> Notifications </a>
                </li>
                <li>
                    <a href="basic_ui_scrollspy.html"> Scroll Spy </a>
                </li>
                <li>
                    <a href="basic_ui_session_timeout.html"> Session Timeout </a>
                </li>
                <li>
                    <a href="basic_ui_sweet_alerts.html"> Sweet Alerts </a>
                </li>
                <li>
                    <a href="basic_ui_tabs.html"> Tabs </a>
                </li>
                <li>
                    <a href="basic_ui_tour_tutorial.html"> Tour Tutorial </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="submenu" id="uiElementsMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">UI Elements</h5>
                <p>Our being able to do what we like best.</p>
            </div>
            <ul class="submenu-list">
                <li>
                    <a href="ui_elements_alerts.html"> Alerts </a>
                </li>
                <li>
                    <a href="ui_elements_avatar.html"> Avatar </a>
                </li>
                <li>
                    <a href="ui_elements_badges.html"> Badges </a>
                </li>
                <li>
                    <a href="ui_elements_breadcrumbs.html"> Breadcrumbs </a>
                </li>                            
                <li>
                    <a href="ui_elements_buttons.html"> Buttons </a>
                </li>
                <li>
                    <a href="ui_elements_colors.html"> Colors </a>
                </li>
                <li> 
                    <a href="ui_elements_dropdowns.html"> Dropdown </a>
                </li>
                <li>
                    <a href="ui_elements_grid.html"> Grid </a>
                </li>
                <li>
                    <a href="ui_elements_jumbotron.html"> Jumbotron </a>
                </li>
                <li>
                    <a href="ui_elements_list_group.html"> List Group </a>
                </li>
                <li>
                    <a href="ui_elements_loading_spinners.html"> Loading Spinners </a>
                </li>
                <li>
                    <a href="ui_elements_pagination.html"> Pagination </a>
                </li>
                <li>
                    <a href="ui_elements_popovers.html"> Popovers </a>
                </li>
                <li>
                    <a href="ui_elements_progress_bar.html"> Progress Bar </a>
                </li>
                <li>
                    <a href="ui_elements_ribbons.html"> Ribbons </a>
                </li>
                <li>
                    <a href="ui_elements_tooltips.html"> Tooltips </a>
                </li>
                <li>
                    <a href="ui_elements_typography.html"> Typography </a>
                </li>
                <li>
                    <a href="ui_elements_video.html"> Video </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="submenu" id="formsMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Forms</h5>
                <p>Et harum quidem rerum facilis et expedita.</p>
            </div>
            <ul class="submenu-list">
                <li>
                    <a data-toggle="collapse" href="#formControls" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle">
                      Controls <i class="las la-angle-right sidemenu-right-icon"></i>
                    </a>
                    <ul class="sub-submenu-list collapse" id="formControls"> 
                        <li>
                            <a href="forms_controls_base_input.html"> Base Input </a>
                        </li>
                        <li>
                            <a href="forms_controls_input_groups.html"> Input Groups </a>
                        </li>
                        <li>
                            <a href="forms_controls_checkbox.html"> Checkbox </a>
                        </li>
                        <li>
                            <a href="forms_controls_radio.html"> Radio </a>
                        </li>
                        <li>
                            <a href="forms_controls_switch.html"> Switch </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a data-toggle="collapse" href="#formWidgets" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle">
                      Widgets <i class="las la-angle-right sidemenu-right-icon"></i>
                    </a>
                    <ul class="sub-submenu-list collapse" id="formWidgets"> 
                        <li>
                            <a href="forms_widgets_picker.html"> Picker </a>
                        </li>
                        <li>
                            <a href="forms_widgets_tagify.html"> Tagify </a>
                        </li>
                        <li>
                            <a href="forms_widgets_touch_spin.html"> Touch Spin </a>
                        </li>
                        <li>
                            <a href="forms_widgets_maxlength.html"> Max Length </a>
                        </li>
                        <li>
                            <a href="forms_widgets_switch.html"> Switch </a>
                        </li>
                        <li>
                            <a href="forms_widgets_select_splitter.html"> Select Splitter</a>
                        </li>
                        <li>
                            <a href="forms_widgets_bootstrap_select.html"> Bootstrap Select </a>
                        </li>
                        <li>
                            <a href="forms_widgets_select_2.html"> Select 2 </a>
                        </li>
                        <li>
                            <a href="forms_widgets_input_masks.html"> Input Masks </a>
                        </li>
                        <li>
                            <a href="forms_widgets_autogrow.html"> Autogrow </a>
                        </li>
                        <li>
                            <a href="forms_widgets_range_slider.html"> Range Slider </a>
                        </li>
                        <li>
                            <a href="forms_widgets_clipboard.html"> Clipboard </a>
                        </li>
                        <li>
                            <a href="forms_widgets_typeahead.html"> Typeahead </a>
                        </li>
                        <li>
                            <a href="forms_widgets_captcha.html"> Captcha </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="forms_validation.html"> Validation </a>
                </li>
                <li>
                    <a href="forms_layouts.html"> Layouts </a>
                </li>
                <li>
                    <a href="forms_text_editor.html"> Text Editor </a>
                </li>
                <li>
                    <a href="forms_file_upload.html"> File Upload </a>
                </li>
                <li>
                    <a href="forms_multiple_step.html"> Multiple Step </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="submenu" id="mapsMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Maps</h5>
                <p>Excepteur sint occaecat cupidatat proident.</p>
            </div>
            <ul class="submenu-list">
                <li>
                    <a href="maps_leaflet_map.html"> Leaflet Map </a>
                </li>
                <li>
                    <a href="maps_vector_map.html"> Vector Map </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="submenu" id="chartsMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Charts</h5>
                <p>Nemo enim ipsam voluptatem quia voluptas.</p>
            </div>
            <ul class="submenu-list">
                <li>
                    <a href="charts_apex_chart.html"> Apex Chart </a>
                </li>
                <li>
                    <a href="charts_chartlist.html"> Chartlist Charts </a>
                </li>  
                <li>
                    <a href="charts_chartjs.html"> ChartJS </a>
                </li>
                <li>
                    <a href="charts_morris_chart.html"> Morris Charts </a>
                </li>    
            </ul>
        </div>
    </div>
    <div class="submenu" id="starterKitMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Starter Kit</h5>
                <p>Adipisci velit, sed quia non numquam eius.</p>
            </div>
            <ul class="submenu-list">
                <li>
                    <a href="starter_kit_blank_page.html"> Blank Page </a>
                </li>
                <li>
                    <a href="starter_kit_breadcrumbs.html"> Breadcrumbs </a>
                </li>  
            </ul>
        </div>
    </div>
    <div class="submenu" id="multiLevelMenu">
        <div class="submenu-info">
            <div class="submenu-inner-info">
                <h5 class="mb-3">Multi Level</h5>
                <p>Quis autem vel eum iure reprehenderit qui.</p>
            </div>
            <ul class="submenu-list">
                <li>
                    <a data-toggle="collapse" href="#multiLevelLevelTwo" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle"> Level 2 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                    <ul class="collapse sub-submenu-list" id="multiLevelLevelTwo"> 
                        <li>
                            <a href="javascript:void(0)"> Link 1 </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"> Link 2 </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a data-toggle="collapse" href="#multiLevelLevelThree" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle"> Level 3 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                    <ul class="collapse sub-submenu-list" id="multiLevelLevelThree"> 
                        <li>
                            <a href="javascript:void(0)"> Link 1</a>
                        </li>
                        <li>
                            <a data-toggle="collapse" href="#multiLevelLevelThreeOne" role="button" aria-expanded="false" aria-controls="collapseExample" class="dropdown-toggle"> Link 2 <i class="las la-angle-right sidemenu-right-icon"></i> </a>
                            <ul class="collapse list-unstyled sub-sub-submenu-list" id="multiLevelLevelThreeOne"> 
                                <li>
                                    <a href="javascript:void(0)"> Link 1</a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"> Link 2 </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div> --}}
</div>