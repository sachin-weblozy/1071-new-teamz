<div class="right-bar">
    <div class="h-100">
        <div class="simplebar-wrapper" style="margin: 0px;">
            <div class="simplebar-mask">
                <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                    <div class="simplebar-content-wrapper" style="height: 100%;">
                        <div class="simplebar-content" style="padding: 0px;">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs nav-bordered nav-justified" role="tablist">
                                {{-- <li class="nav-item">
                                    <a class="nav-link  active" data-toggle="tab" href="#chat-tab" role="tab" aria-selected="true">
                                        <i class="las la-sms"></i>
                                    </a>
                                </li> --}}
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#status-tab" role="tab" aria-selected="false">
                                        <i class="las la-tasks"></i>
                                    </a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#settings-tab" role="tab" aria-selected="false">
                                        <i class="las la-cog"></i>
                                    </a>
                                </li> --}}
                            </ul>
                            <!-- Tab panes starts -->
                            <div class="tab-content pt-0 rightbar-tab-container">
                                {{-- <div class="tab-pane  rightbar-tab" id="chat-tab" role="tabpanel">
                                    <form class="search-bar p-3">
                                        <div class="position-relative">
                                            <input type="text" class="form-control search-form-control" placeholder="Search">
                                            <span class="mdi mdi-magnify"></span>
                                        </div>
                                    </form>
                                    <h6 class="right-bar-heading px-3 mt-2 text-uppercase">Chat Groups</h6>
                                    <div class="p-2">
                                        <a href="javascript: void(0);" class="text-reset group-item pl-3 mb-2 d-block">
                                            <i class="las la-dot-circle mr-1 text-warning"></i>
                                            <span class="mb-0 mt-1 text-warning">Frontend Team</span>
                                        </a>
                                        <a href="javascript: void(0);" class="text-reset group-item pl-3 mb-2 d-block">
                                            <i class="las la-dot-circle mr-1 text-danger"></i>
                                            <span class="mb-0 mt-1 text-danger">Back Office</span>
                                        </a>
                                        <a href="javascript: void(0);" class="text-reset group-item pl-3 d-block">
                                            <i class="las la-dot-circle mr-1 text-info"></i>
                                            <span class="mb-0 mt-1 text-info">Personal</span>
                                        </a>
                                    </div>
                                    <h6 class="right-bar-heading px-3 mt-2 text-uppercase">My Favourites <a href="javascript: void(0);"><i class="las la-angle-right"></i></i></a></h6>
                                    <div class="p-2">
                                        <a href="javascript: void(0);" class="text-reset">
                                            <div class="media pt-0">
                                                <div class="position-relative mr-2">
                                                    <img src="assets/img/profile-1.jpg" class="rounded-circle avatar-sm ml-2" alt="user-pic">
                                                    <span class="user-status online"></span>
                                                </div>
                                                <div class="media-body overflow-hidden mr-2">
                                                    <h6 class="mt-0 mb-1 font-13">Andrew Mackie</h6>
                                                    <div class="font-12">
                                                        <p class="mb-0 text-truncate">It will seem like simplified English.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <h6 class="right-bar-heading px-3 mt-2 text-uppercase">Chats <a href="javascript: void(0);"><i class="las la-angle-right"></i></i></a></h6>
                                    <div class="p-2 pb-4">
                                        <a href="javascript: void(0);" class="text-reset">
                                            <div class="media pt-0">
                                                <div class="position-relative mr-2">
                                                    <img src="assets/img/profile-3.jpg" class="rounded-circle avatar-sm ml-2" alt="user-pic">
                                                    <span class="user-status online"></span>
                                                </div>
                                                <div class="media-body overflow-hidden mr-2">
                                                    <h6 class="mt-0 mb-1 font-13">Owen Hargrieves</h6>
                                                    <div class="font-12">
                                                        <p class="mb-0 text-truncate">That's really cool</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="javascript: void(0);" class="text-reset">
                                            <div class="media">
                                                <div class="position-relative mr-2">
                                                    <img src="assets/img/profile-4.jpg" class="rounded-circle avatar-sm ml-2" alt="user-pic">
                                                    <span class="user-status online"></span>
                                                </div>
                                                <div class="media-body overflow-hidden mr-2">
                                                    <h6 class="mt-0 mb-1 font-13">Riyana Giyan</h6>
                                                    <div class="font-12">
                                                        <p class="mb-0 text-truncate">When do you send me those files ?</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                        <div class="text-center pt-4">
                                            <a href="javascript:void(0);" class="btn btn-sm btn-primary">
                                                Load more
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="tab-paneactive rightbar-tab overflow-auto" id="status-tab" role="tabpanel">
                                    <h6 class="right-bar-heading p-2 px-3 mt-2 text-uppercase">My Tasks </h6>
                                    <livewire:rightbar-tasks />
                                </div>
                                {{-- <div class="tab-pane rightbar-tab" id="settings-tab" role="tabpanel">
                                    <h6 class="right-bar-heading p-2 px-3 mt-2 text-uppercase">Account Setting </h6>
                                    <div class="px-2">
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Sync Contacts</p>
                                        </div>
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Auto Update</p>
                                        </div>
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Recieve Notifications</p>
                                        </div>
                                    </div>
                                    <h6 class="right-bar-heading p-2 px-3 mt-2 text-uppercase">Mail Setting </h6>
                                    <div class="px-2">
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Mail Auto Responder</p>
                                        </div>
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Auto Trash Delete</p>
                                        </div>
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox">
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Custom Signature</p>
                                        </div>
                                    </div>
                                    <h6 class="right-bar-heading p-2 px-3 mt-2 text-uppercase">Chat Setting </h6>
                                    <div class="px-2">
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Show Online</p>
                                        </div>
                                        <div class="switch-container mb-3 pl-2">
                                            <label class="switch">
                                                <input type="checkbox" checked>
                                                <span class="slider round primary-switch"></span>
                                            </label>
                                            <p class="ml-3 text-dark">Chat Notifications</p>
                                        </div>
                                    </div>
                                    <div class="px-2 text-center pt-4">
                                        <a href="javascript:void(0);" class="btn btn-sm btn-danger">
                                            Set Default
                                        </a>
                                        <button class="ripple-button ripple-button-primary btn-sm" type="button">
                                            <div class="ripple-ripple js-ripple">
                                              <span class="ripple-ripple__circle"></span>
                                            </div>
                                            Ripple Effect
                                          </button>
                                    </div>
                                </div> --}}
                            </div>
                            <!-- Tab panes ends -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>