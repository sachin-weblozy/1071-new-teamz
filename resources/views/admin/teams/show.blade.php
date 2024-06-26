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

    <div class="datatables">
        <!-- start File export -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
              <h5 class="card-title  mb-0">Team Members</h5>
              <div class="">
                @can('Team Edit')
                <a href="{{ route('admin.teams.edit', $team->id) }}" class="btn btn-primary">Manage</a>
                @endcan
              </div>
            </div>
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                <thead>
                  <!-- start row -->
                  <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    @role('superadmin')
                    <th>Tasks</th>
                    <th>Report</th>
                    @endrole
                    @role('user')
                      @if($team->lead_id == Auth::id())
                      <th>Tasks</th>
                      <th>Report</th>
                      @endif
                    @endrole
                  </tr>
                  <!-- end row -->
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($members as $member)
                  <!-- start row -->
                  <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $member->name ?? '' }}</td>
                    <td>{{ $member->email ?? '' }}</td>
                      @role('superadmin')
                      <td>
                        <div class="action-btn">
                          <a href="{{ route('admin.users.tasks',encrypt($member->id)) }}"><button class="btn btn-outline-primary btn-sm">Tasks</button></a>
                        </div>
                      </td>
                      <td>
                        <div class="action-btn">
                          <a href="{{ route('admin.users.attendance',encrypt($member->id)) }}"><button class="btn btn-outline-success btn-sm">Daily</button></a>
                          <a href="{{ route('admin.userreport.weekly',encrypt($member->id)) }}"><button class="btn btn-outline-info btn-sm">Weekly</button></a>
                        </div>
                      </td>
                      @endrole
                      @role('user')
                          @if($team->lead_id == Auth::id())
                          <td>
                            <div class="action-btn">
                              <a href="{{ route('admin.users.tasks',encrypt($member->id)) }}"><button class="btn btn-outline-primary btn-sm">Tasks</button></a>
                            </div>
                          </td>
                          <td>
                            <div class="action-btn">
                              <a href="{{ route('admin.users.attendance',encrypt($member->id)) }}"><button class="btn btn-outline-success btn-sm">Daily</button></a>
                              <a href="{{ route('admin.userreport.weekly',encrypt($member->id)) }}"><button class="btn btn-outline-info btn-sm">Weekly</button></a>
                            </div>
                          </td>
                          @endif
                      @endrole
                  </tr>
                  <!-- end row -->
                  @php $i++; @endphp
                  @endforeach
                  <tfoot>
                      <!-- start row -->
                      <tr>
                          <th>Sr No.</th>
                          <th>Title</th>
                          <th>Email</th>
                          @role('superadmin')
                          <th>Tasks</th>
                          <th>Report</th>
                          @endrole
                          @role('user')
                            @if($team->lead_id == Auth::id())
                            <th>Tasks</th>
                            <th>Report</th>
                            @endif
                          @endrole
                      </tr>
                      <!-- end row -->
                  </tfoot>
              </table>
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
@endsection