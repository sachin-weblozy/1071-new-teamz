@extends('layouts.master')

@section('pagestyles')
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
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Spaces
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="datatables">
      <!-- start File export -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
            <h5 class="card-title  mb-0">List of Spaces</h5>
            <div class="">
              @can('Space Create')
              <a href="{{ route('admin.spaces.create') }}" class="btn btn-primary">Create New</a>
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
                  <th>Project</th>
                  <th>Members</th>
                  <th>Action</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($spaces as $space)
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
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('pagescripts')
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-basic.init.js') }}"></script>
@endsection