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
            <h4 class="mb-4 mb-md-0 card-title">{{ $user->name }}'s Work Report - {{ Helper::formatDate($timereport->created_at) ?? '' }}</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Daily Report
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
        <div class="card-body">
          <div class="d-flex mb-1 align-items-center">
            <div>
              <h4 class="card-title mb-0">Attendance</h4>
            </div>
          </div>
          <div class="table-responsive border rounded-1">
            <table class="table mb-0">
              <thead class="table-primary">
                <!-- start row -->
                <tr>
                  <th>SignIn At</th>
                  <th>Break Start At</th>
                  <th>Break End At</th>
                  <th>SignOut At</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @if($timereport)
                <tr>
                    <td>{{ Helper::formatTime($timereport->sign_in) ?? '' }}</td>
                    <td>{{ Helper::formatTime($timereport->break_start) ?? '' }}</td>
                    <td>{{ Helper::formatTime($timereport->break_end) ?? '' }}</td>
                    <td>{{ Helper::formatTime($timereport->sign_out) ?? '' }}</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
          <div class="d-flex mb-1 align-items-center">
            <div>
              <h4 class="card-title mb-0">Completed Tasks</h4>
            </div>
          </div>
          <div class="table-responsive border rounded-1">
            <table class="table mb-0">
              <thead class="table-success">
                <!-- start row -->
                <tr>
                  <th>Title</th>
                  <th>Deadline</th>
                  <th>Completed</th>
                  <th>Priority</th>
                  <th>Assigned By</th>
                  <th>Space</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @forelse($completedtasks as $task)
                <tr>
                    <td>{{ $task->title ?? '' }}</td>
                    <td>{{ Helper::getDateTime($task->deadline) ?? '' }}</td>
                    <td>{{ Helper::formatTime($task->completed_at) ?? '' }}</td>
                    <td>
                        @if($task->priority == 1)
                        <span class="badge badge-danger light font-10">High</span>
                        @elseif($task->priority == 2)
                        <span class="badge badge-warning light font-10">Medium</span>
                        @elseif($task->priority == 3)
                        <span class="badge badge-success-teal light font-10">Low</span>
                        @endif
                    </td>
                    <td>{{ $task->assignedby->name ?? '' }}</td>
                    <td>
                        @if($task->space != null)
                        <span class="badge badge-secondary light font-10">{{ $task->space->name }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                @endforelse
              </tbody>
            </table>
          </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
          <div class="d-flex mb-1 align-items-center">
            <div>
              <h4 class="card-title mb-0">Notes</h4>
            </div>
          </div>
          <div class="border rounded-1">
            {!! $timereport->notes ?? '' !!}
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