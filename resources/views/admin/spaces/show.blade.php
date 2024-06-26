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
            <h4 class="mb-4 mb-md-0 card-title">Spaces</h4>
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
                            Spaces
                        </span>
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    {{ $space->name ?? 'Space' }}
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
            <div class="col-lg-4 order-lg-1 order-2">
              {{-- <div class="d-flex align-items-center justify-content-around m-4">
                <div class="text-center">
                  <i class="ti ti-file-description fs-6 d-block mb-2"></i>
                  <h4 class="mb-0 fw-semibold lh-1">938</h4>
                  <p class="mb-0 ">Posts</p>
                </div>
                <div class="text-center">
                  <i class="ti ti-user-circle fs-6 d-block mb-2"></i>
                  <h4 class="mb-0 fw-semibold lh-1">3,586</h4>
                  <p class="mb-0 ">Followers</p>
                </div>
                <div class="text-center">
                  <i class="ti ti-user-check fs-6 d-block mb-2"></i>
                  <h4 class="mb-0 fw-semibold lh-1">2,659</h4>
                  <p class="mb-0 ">Following</p>
                </div>
              </div> --}}
            </div>
            <div class="col-lg-4 mt-3 mb-2 order-lg-2 order-1">
              <div class="">
                <div class="text-center">
                  <h4 class="mb-0">{{ $space->name ?? '' }}</h4>
                  <p class="mb-0">{{ $space->project->title ?? '' }}</p>
                </div>
              </div>
            </div>
            <div class="col-lg-4 order-last">
              {{-- <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-end my-3 mx-4 pe-4 gap-3">
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
              </ul> --}}
            </div>
          </div>
          <ul class="nav nav-pills user-profile-tab justify-content-center mt-2 bg-primary-subtle rounded-2 rounded-top-0" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active hstack gap-2 rounded-0 fs-12 py-6" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="true">
                <i class="ti ti-messages fs-5"></i>
                <span class="d-none d-md-block">Chats</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-followers-tab" data-bs-toggle="pill" data-bs-target="#pills-followers" type="button" role="tab" aria-controls="pills-followers" aria-selected="false">
                <i class="ti ti-list-check fs-5"></i>
                <span class="d-none d-md-block">Tasks</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-friends-tab" data-bs-toggle="pill" data-bs-target="#pills-friends" type="button" role="tab" aria-controls="pills-friends" aria-selected="false">
                <i class="ti ti-users fs-5"></i>
                <span class="d-none d-md-block">Members</span>
              </button>
            </li>
            {{-- <li class="nav-item" role="presentation">
              <button class="nav-link hstack gap-2 rounded-0 fs-12 py-6" id="pills-gallery-tab" data-bs-toggle="pill" data-bs-target="#pills-gallery" type="button" role="tab" aria-controls="pills-gallery" aria-selected="false">
                <i class="ti ti-box fs-5"></i>
                <span class="d-none d-md-block">Project</span>
              </button>
            </li> --}}
          </ul>
        </div>
    </div>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
          <div class="row">
            @livewire('space-chat', ['space_id' => $space->id])
          </div>
        </div>
        <div class="tab-pane fade" id="pills-followers" role="tabpanel" aria-labelledby="pills-followers-tab" tabindex="0">
            @livewire('space-tasks', ['space_id' => $space->id])
        </div>
        <div class="tab-pane fade" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
            @include('admin.spaces.members')
        </div>
        <div class="tab-pane fade" id="pills-gallery" role="tabpanel" aria-labelledby="pills-gallery-tab" tabindex="0">
            {{-- @include('admin.spaces.project') --}}
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
<script src="{{ asset('assets/js/apps/chat.js') }}"></script>
@endsection