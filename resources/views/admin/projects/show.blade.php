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
            <h4 class="mb-4 mb-md-0 card-title">Project Detail</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item d-flex align-items-center">
                    <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.projects.index') }}">
                        <span class="badge fw-medium fs-2 bg-primary-subtle text-muted">
                            Projects
                        </span>
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    {{ $project->title ?? 'Details' }}
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
          <div class="row align-items-center">
            <div class="col-lg-12 order-lg-1 order-2">
              <div class=" m-4">
                <h4 class="mb-3">{{ $project->title ?? '' }}</h4>
                  <div class="vstack gap-3 mt-4">
                    <div class="hstack gap-6">
                      <i class="ti ti-link text-dark fs-6"></i>
                      <h6 class=" mb-0">URL: <a href="{{ $project->url ?? '#' }}" target="_blank">{{ $project->url ?? '' }}</a></h6>
                    </div>
                    <div class="hstack gap-6">
                      <i class="ti ti-clock text-dark fs-6"></i>
                      <h6 class=" mb-0">Deadline: {{ Helper::formatDate($project->deadline) ?? '' }}</h6>
                    </div>
                    <div class="hstack gap-6">
                      <i class="ti ti-users text-dark fs-6"></i>
                      <h6 class=" mb-0">Departments: 
                        @php $selectedDepts = $project->departments->pluck('id')->toArray(); @endphp
                        @foreach($departments as $department)
                            @if(in_array($department->id, old('departments', $selectedDepts)))
                            <span class="mb-1 badge text-bg-info">{{ $department->name }}</span>
                            @endif
                        @endforeach
                      </h6>
                    </div>
                    <div class="hstack gap-6">
                      <i class="ti ti-brand-flightradar24 text-dark fs-6"></i>
                      <h6 class=" mb-0">Status: <span class="mb-1 badge text-bg-success">{{ $project->status ?? '' }}</span></h6>
                    </div>
                  </div>
              </div>
            </div>
            {{-- <div class="col-lg-6 order-last">
              <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-4 gap-3">
                <li>
                  <a class="d-flex align-items-center justify-content-center btn btn-primary p-2 fs-4 rounded-circle" href="javascript:void(0)" width="30" height="30">
                    <i class="ti ti-brand-facebook"></i>
                  </a>
                </li>
                <li>
                  <a class="btn btn-secondary d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="javascript:void(0)">
                    <i class="ti ti-brand-dribbble"></i>
                  </a>
                </li>
                <li>
                  <a class="btn btn-danger d-flex align-items-center justify-content-center p-2 fs-4 rounded-circle" href="javascript:void(0)">
                    <i class="ti ti-brand-youtube"></i>
                  </a>
                </li>
                <li>
                  <button class="btn btn-primary text-nowrap">Add To Story</button>
                </li>
              </ul>
            </div> --}}
          </div>
          <ul class="nav nav-pills user-profile-tab justify-content-end mt-2 bg-primary-subtle rounded-2 rounded-top-0" id="pills-tab" role="tablist">
            
            <li class="nav-item" role="presentation">
              <button class="nav-link active hstack gap-2 rounded-0 fs-12 py-6" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                {{-- <i class="ti ti-user-circle fs-5"></i> --}}
                <span class="d-none d-md-block">Requirements</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false">
                {{-- <i class="ti ti-heart fs-5"></i> --}}
                <span class="d-none d-md-block">Meetings</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false">
                {{-- <i class="ti ti-user-circle fs-5"></i> --}}
                <span class="d-none d-md-block">Spaces</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">
                {{-- <i class="ti ti-photo-plus fs-5"></i> --}}
                <span class="d-none d-md-block">Members</span>
              </button>
            </li>

          </ul>
        </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <div class="row">
            <div class="col-lg-12">
              <div class="card shadow-none border">
                <div class="card-body">
                  <h4 class="mb-3">Requirements</h4>
                  {!! $project->requirement ?? '' !!}
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
            @include('admin.projects.meetings')
        </div>

        <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
            @include('admin.projects.spaces')
        </div>

        <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">
            @include('admin.projects.members')
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