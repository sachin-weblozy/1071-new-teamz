@extends('layouts.master')

@section('pagestyles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-md-0 card-title">Team Details</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item d-flex align-items-center">
                    <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.teams.index') }}">
                        <span class="badge fw-medium fs-2 bg-primary-subtle text-muted">
                            Teams
                        </span>
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Members
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
                <h4 class="mb-3">{{ $team->name ?? '' }}</h4>
                  <div class="vstack gap-3 mt-4">
                    <div class="hstack gap-6">
                      <i class="ti ti-brand-flightradar24 text-dark fs-6"></i>
                      <h6 class=" mb-0">Lead: {{ $team->lead->name ?? '' }}</h6>
                    </div>
                    <div class="hstack gap-6">
                      <i class="ti ti-users text-dark fs-6"></i>
                      <h6 class=" mb-0">Department: {{ $team->dept->name ?? '' }}</h6>
                    </div>
                    {{-- <div class="hstack gap-6">
                      <i class="ti ti-users text-dark fs-6"></i>
                      <h6 class=" mb-0">Active Members: 
                        <ul class="hstack mb-0 pt-1">
                            @forelse($activeUsers as $user)
                            <li class="ms-n8">
                                <a href="javascript:void(0)" class="me-1">
                                  <img src="{{ $user->profile_photo_url ?? '' }}" class="rounded-circle border border-2 border-white" width="35" height="35" alt="{{ $user->name }}-img">
                                </a>
                              </li>
                            @empty 
                            @endforelse
                        </ul>
                      </h6>
                    </div> --}}
                  </div>
              </div>
            </div>
            
          </div>
        </div>
    </div>


    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
      <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Members <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $members->count() ?? '' }}</span>
      </h3>

      @if($isLeadOrHead==true)
      <div class="position-relative">
        <a href="{{ route('admin.teams.edit', encrypt($team->id)) }}" class="btn btn-primary">Manage</a>
      </div>
      @endif
    </div>


    <div class="row">
      @php $i=1; @endphp
      @foreach($members as $member)
      
        <div class=" col-md-6 col-xl-4">
          <div class="card hover-img">
            <div class="card-body p-4 text-center border-bottom">
              <img src="{{ $member->profile_photo_url ?? '' }}" alt="matdash-img" class="rounded-circle mb-3" width="80" height="80">
              <h5 class="fw-semibold mb-0">{{ $member->name ?? '' }}</h5>
              <span class="text-dark fs-2">{{ $member->email ?? '' }}</span>
            </div>
            <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
              @role('superadmin')
              <li class="position-relative">
                <a href="{{ route('admin.users.tasks',encrypt($member->id)) }}"><button class="btn btn-outline-primary btn-sm mx-1">Tasks</button></a>
              </li>
              <li class="position-relative">
                <a href="{{ route('admin.users.attendance',encrypt($member->id)) }}"><button class="btn btn-outline-success btn-sm mx-1">Daily Report</button></a>
              </li>
              <li class="position-relative">
                <a href="{{ route('admin.userreport.weekly',encrypt($member->id)) }}"><button class="btn btn-outline-info btn-sm mx-1">Weekly Report</button></a>
              </li>
              @endrole
              @role('user')
              @if($isLeadOrHead==true)
              <li class="position-relative">
                <a href="{{ route('admin.users.tasks',encrypt($member->id)) }}"><button class="btn btn-outline-primary btn-sm mx-1">Tasks</button></a>
              </li>
              <li class="position-relative">
                <a href="{{ route('admin.users.attendance',encrypt($member->id)) }}"><button class="btn btn-outline-success btn-sm mx-1">Daily Report</button></a>
              </li>
              <li class="position-relative">
                <a href="{{ route('admin.userreport.weekly',encrypt($member->id)) }}"><button class="btn btn-outline-info btn-sm mx-1">Weekly Report</button></a>
              </li>
              @endif
              @endrole
            </ul>
          </div>
        </div>
      
      
      <!-- end row -->
      @php $i++; @endphp
      @endforeach
    </div>

    
  </div>
@endsection

@section('pagescripts')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/forms/select2.init.js') }}"></script>
@endsection