@extends('layouts.master')

@section('pagestyles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-md-0 card-title">Profile</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    {{ $user->name ?? '' }}
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    
    <div class="card overflow-hidden">
        <div class="card-body p-0">
          <img src="{{ asset('assets/images/backgrounds/profilebg.jpg') }}" alt="bg-img" class="img-fluid">
          <div class="row align-items-center">
            <div class="col-lg-4 order-lg-1 order-2">
              <div class="d-flex align-items-center justify-content-around m-4">
                <div class="text-center">
                  <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                  <h4 class="mb-0 fw-semibold lh-1">{{ $user->postedFeeds->count() ?? 0 }}</h4>
                  <p class="mb-0 ">Posts</p>
                </div>
                {{-- <div class="text-center">
                  <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                  <h4 class="mb-0 fw-semibold lh-1">3,586</h4>
                  <p class="mb-0 ">Followers</p>
                </div>
                <div class="text-center">
                  <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                  <h4 class="mb-0 fw-semibold lh-1">2,659</h4>
                  <p class="mb-0 ">Following</p>
                </div> --}}
              </div>
            </div>
            <div class="col-lg-4 mt-n3 order-lg-2 order-1">
              <div class="mt-n5">
                <div class="d-flex align-items-center justify-content-center mb-2">
                  <div class="d-flex align-items-center justify-content-center round-110">
                    <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden round-100">
                      <img src="{{ $user->profile_photo_url ?? asset('assets/images/profile/user-1.jpg') }}" alt="user-img" class="w-100 h-100">
                    </div>
                  </div>
                </div>
                <div class="text-center">
                  <h5 class="mb-0">{{ $user->name ?? '' }}</h5>
                  <p class="mb-0">{{ $user->email ?? '' }}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 order-last">
              <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-4 gap-3">
                @if($user->id == Auth::id())
                <li>
                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary text-nowrap">Edit Profile</a>
                  </li>
                @endif
              </ul>
            </div>
          </div>
          <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active hstack gap-2 rounded-0 fs-12 py-6" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                <span class="d-none d-md-block">Profile</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false">
                <span class="d-none d-md-block">Meetings</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false">
                <span class="d-none d-md-block">Spaces</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">
                <span class="d-none d-md-block">Projects</span>
              </button>
            </li>
          </ul>
        </div>
      </div>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <div class="row">
            <div class="col-lg-4">
              <div class="card shadow-none border">
                <div class="card-body">
                  <h4 class="mb-3">Introduction</h4>
                  <p class="card-subtitle">Hello, I am {{$user->name ?? ''}}</p>
                  <div class="vstack gap-3 mt-4">
                    <div class="hstack gap-6">
                      <i class="ti ti-phone text-dark fs-6"></i>
                      <h6 class=" mb-0">{{ $user->phone ?? '' }}</h6>
                    </div>
                    <div class="hstack gap-6">
                      <i class="ti ti-mail text-dark fs-6"></i>
                      <h6 class=" mb-0">{{ $user->email ?? '' }}</h6>
                    </div>
                    <div class="hstack gap-6">
                      <i class="ti ti-users text-dark fs-6"></i>
                      <h6 class=" mb-0">
                        @forelse($user->assignedTeams as $team)
                        <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                            {{ $team->name ?? '' }}
                        </span>
                        @empty @endforelse
                      </h6>
                    </div>
                    <div class="hstack gap-6">
                        <i class="ti ti-user text-dark fs-6"></i>
                        <h6 class=" mb-0">Employee ID: {{ $user->eid ?? '' }}</h6>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
                @livewire('feeds', ['usrid' => $user->id])
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
          <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
            <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Meetings <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $user->assignedMeetings->count() ?? '' }}</span>
            </h3>
          </div>
          <div class="row">
            <div class="datatables">
                <!-- start File export -->
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
                      <h5 class="card-title  mb-0">List of Meetings</h5>
                    </div>
                    <div class="table-responsive">
                      <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                        <thead>
                          <!-- start row -->
                          <tr>
                            <th>Sr No.</th>
                            <th>URL</th>
                            <th>Title</th>
                            <th>Start At</th>
                            <th>End At</th>
                            <th>Project</th>
                            <th>Status</th>
                            @if($user->id == Auth::id())<th>Action</th>@endif
                          </tr>
                          <!-- end row -->
                        </thead>
                        <tbody>
                          @php $i=1; @endphp
                          @foreach($user->assignedMeetings as $meeting)
                          <!-- start row -->
                          <tr>
                            <td>{{ $i }}</td>
                            <td>
                              @if($meeting->meeting_url)
                              <a href="{{ $meeting->meeting_url ?? '#' }}" target="_blank"><button class="btn btn-primary btn-sm">Join Meeting</button></a>
                              @endif
                            </td>
                            <td>{{ $meeting->title ?? '' }}</td>
                            <td>{{ Helper::getDateTime($meeting->start_at) ?? '' }}</td>
                            <td>{{ Helper::getDateTime($meeting->end_at) ?? '' }}</td>
                            <td>{{ $meeting->project->title ?? '' }}</td>
                            <td><span class="mb-1 badge text-bg-primary">{{ $meeting->status }}</span></td>
                            @if($user->id == Auth::id())
                            <td>
                                <div class="action-btn">
                                    <span class="mb-1 badge text-bg-primary">{{ $meeting->status }}</span>
                                    
                                </div>
                            </td>
                            @endif
                          </tr>
                          <!-- end row -->
                          @php $i++; @endphp
                          @endforeach
                          <tfoot>
                              <!-- start row -->
                              <tr>
                                  <th>Sr No.</th>
                                  <th>URL</th>
                                  <th>Title</th>
                                  <th>Start At</th>
                                  <th>End At</th>
                                  <th>Project</th>
                                  <th>Status</th>
                                  @if($user->id == Auth::id())<th>Action</th>@endif
                              </tr>
                              <!-- end row -->
                          </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
          <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
            <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Spaces <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2"></span>
            </h3>
          </div>
          <div class="row">
            <div class="datatables">
                <!-- start File export -->
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
                      <h5 class="card-title  mb-0">List of Spaces</h5>
                    </div>
                    <div class="table-responsive">
                      <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                        <thead>
                          <!-- start row -->
                          <tr>
                            <th>Sr No.</th>
                            <th>Name</th>
                            <th>Project</th>
                            <th>Members</th>
                            <th>Action</th>
                          </tr>
                          <!-- end row -->
                        </thead>
                        {{-- <tbody>
                          @php $i=1; @endphp
                          @foreach($user->assignedSpaces as $space)
                          <!-- start row -->
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $space->name ?? '' }}</td>
                            <td>{{ $space->project->title ?? '' }}</td>
                            <td>{{ $space->users->count() }}</td>
                            <td>
                              <div class="action-btn">
                                  <a href="{{ route('admin.spaces.show', $space->id) }}" class="text-primary view ms-2">
                                    <i class="ti ti-eye fs-5"></i>
                                  </a>
                                  <a href="{{ route('admin.spaces.addmembers', $space->id) }}" class="text-primary view ms-2">
                                    <i class="ti ti-plus fs-5"></i>
                                  </a>
                                  @can('Space Edit')
                                    <a href="{{ route('admin.spaces.edit', $space->id) }}" class="text-primary edit ms-2">
                                      <i class="ti ti-pencil fs-5"></i>
                                    </a>
                                    @endcan
                                    @can('Space Delete')
                                    <a type="button" class="text-dark delete ms-2" onclick="event.preventDefault(); document.getElementById('delete-form{{ $space->id }}').submit();">
                                      <i class="ti ti-trash fs-5"></i>
                                    </a>
                                  <form id="delete-form{{ $space->id }}" action="{{ route('admin.spaces.destroy', $space->id) }}" method="POST" class="d-none">
                                      @csrf
                                      @method('delete')
                                  </form>
                                  @endcan
                                  
                                </div>
                            </td>
                          </tr>
                          <!-- end row -->
                          @php $i++; @endphp
                          @endforeach
                          <tfoot>
                              <!-- start row -->
                              <tr>
                                  <th>Sr No.</th>
                                  <th>Name</th>
                                  <th>Project</th>
                                  <th>Members</th>
                                  <th>Action</th>
                              </tr>
                              <!-- end row -->
                          </tfoot>
                        </tbody> --}}
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">
          <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
            <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Projects <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $user->assignedProjects->count() }}</span>
            </h3>
          </div>
          <div class="row">
            <div class="datatables">
                <!-- start File export -->
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
                      <h5 class="card-title  mb-0">List of Projects</h5>
                      <div class="">
                        @can('Project Create')
                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Create New</a>
                        <a href="{{ route('admin.crmprojects.list') }}" class="btn btn-secondary"> Import </a>
                        @endcan
                      </div>
                    </div>
                    <div class="table-responsive">
                      <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                        <thead>
                          <!-- start row -->
                          <tr>
                            <th>Sr No.</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>Department</th>
                            @if($user->id == Auth::id())<th>Action</th>@endif
                          </tr>
                          <!-- end row -->
                        </thead>
                        <tbody>
                          @php $i=1; @endphp
                          @foreach($user->assignedProjects as $project)
                          <!-- start row -->
                          <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $project->title ?? '' }}</td>
                            <td>{{ Helper::formatDate($project->deadline) ?? '' }}</td>
                            <td>
                              @php $selectedDepts = $project->departments->pluck('id')->toArray(); @endphp
                              @foreach($departments as $department)
                                  @if(in_array($department->id, old('departments', $selectedDepts)))
                                  <span class="mb-1 badge text-bg-primary">{{ $department->name }}</span>
                                  @endif
                              @endforeach
                            </td>
                            @if($user->id == Auth::id())
                            <td>
                                <div class="action-btn">
                                    <a href="{{ route('admin.projects.show', $project->id) }}" class="text-primary view ms-2">
                                      <i class="ti ti-eye fs-5"></i>
                                    </a>
                                    @can('Project Edit')
                                      <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-primary edit ms-2">
                                        <i class="ti ti-pencil fs-5"></i>
                                      </a>
                                      @endcan
                                      @can('Project Delete')
                                      <a type="button" class="text-dark delete ms-2" onclick="event.preventDefault(); document.getElementById('delete-form{{ $project->id }}').submit();">
                                        <i class="ti ti-trash fs-5"></i>
                                      </a>
                                    <form id="delete-form{{ $project->id }}" action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('delete')
                                    </form>
                                    @endcan
                                    
                                  </div>
                            </td>
                            @endif
                          </tr>
                          <!-- end row -->
                          @php $i++; @endphp
                          @endforeach
                          <tfoot>
                              <!-- start row -->
                              <tr>
                                  <th>Sr No.</th>
                                  <th>Title</th>
                                  <th>Deadline</th>
                                  <th>Department</th>
                                  @if($user->id == Auth::id())<th>Action</th>@endif
                              </tr>
                              <!-- end row -->
                          </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    
    
</div>
@endsection

@section('pagescripts')
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/forms/select2.init.js') }}"></script>
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-basic.init.js') }}"></script>
@endsection