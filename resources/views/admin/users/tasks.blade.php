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
              <h4 class="mb-4 mb-md-0 card-title">{{ $user->name }}'s Tasks</h4>
              <nav aria-label="breadcrumb" class="ms-auto">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item d-flex align-items-center">
                    <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                      <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                    </a>
                  </li>
                  <li class="breadcrumb-item d-flex align-items-center">
                      <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.users.index') }}">
                          <span class="badge fw-medium fs-2 bg-primary-subtle text-muted">
                              Users
                          </span>
                      </a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                      {{ $user->name ?? 'Tasks' }}
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
            <h5 class="card-title  mb-0">Pending Tasks</h5>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
              <thead>
                <!-- start row -->
                <tr>
                    <th>Title</th>
                    <th>Assigned By</th>
                    <th>Deadline</th>
                    <th>Completed At</th>
                    <th>Frequency</th>
                    <th>Priority</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($tasks  as $task)
                <!-- start row -->
                <tr>
                    <td>
                        {{ $task->title ?? '' }}
                    </td>
                    <td>{{ $task->assigned_by->name ?? '' }}</td>
                    <td>
                        {{ Helper::getDateTime($task->deadline) ?? '' }}
                    </td>
                    <td>
                        {{ Helper::getDateTime($task->completed_at) ?? '' }}
                    </td>
                    <td><span class="mb-1 badge  bg-primary">@if($task->recurrence == '0'){{'None'}}@else {{ ucfirst($task->recurrence) }} @endif</span></td>
                    <td>
                        @if($task->priority == 1)
                          <span class="mb-1 badge text-bg-danger">High</span>
                          @elseif($task->priority == 2)
                          <span class="mb-1 badge text-bg-warning">Medium</span>
                          @elseif($task->priority == 3)
                          <span class="mb-1 badge text-bg-success">Low</span>
                        @endif
                    </td>
                </tr>
                <!-- end row -->
                @php $i++; @endphp
                @endforeach
                <tfoot>
                    <!-- start row -->
                    <tr>
                        <th>Title</th>
                        <th>Assigned By</th>
                        <th>Deadline</th>
                        <th>Completed At</th>
                        <th>Frequency</th>
                        <th>Priority</th>
                    </tr>
                    <!-- end row -->
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="datatables">
        <!-- start File export -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
              <h5 class="card-title  mb-0">Completed Tasks</h5>
            </div>
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                <thead>
                  <!-- start row -->
                  <tr>
                      <th>Title</th>
                      <th>Assigned By</th>
                      <th>Deadline</th>
                      <th>Completed At</th>
                      <th>Frequency</th>
                      <th>Priority</th>
                  </tr>
                  <!-- end row -->
                </thead>
                <tbody>
                  @php $i=1; @endphp
                  @foreach($completedTasks as $task)
                  <!-- start row -->
                  <tr>
                      <td>
                          {{ $task->title ?? '' }}
                      </td>
                      <td>{{ $task->assigned_by->name ?? '' }}</td>
                      <td>
                          {{ Helper::getDateTime($task->deadline) ?? '' }}
                      </td>
                      <td>
                          {{ Helper::getDateTime($task->completed_at) ?? '' }}
                      </td>
                      <td><span class="mb-1 badge  bg-primary">@if($task->recurrence == '0'){{'None'}}@else {{ ucfirst($task->recurrence) }} @endif</span></td>
                    <td>
                        @if($task->priority == 1)
                          <span class="mb-1 badge text-bg-danger">High</span>
                          @elseif($task->priority == 2)
                          <span class="mb-1 badge text-bg-warning">Medium</span>
                          @elseif($task->priority == 3)
                          <span class="mb-1 badge text-bg-success">Low</span>
                        @endif
                    </td>
                  </tr>
                  <!-- end row -->
                  @php $i++; @endphp
                  @endforeach
                  <tfoot>
                      <!-- start row -->
                      <tr>
                          <th>Title</th>
                          <th>Assigned By</th>
                          <th>Deadline</th>
                          <th>Completed At</th>
                          <th>Frequency</th>
                          <th>Priority</th>
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