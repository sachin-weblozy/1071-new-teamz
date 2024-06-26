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
              <h4 class="mb-4 mb-md-0 card-title">{{ $user->name }}'s Report [{{ Helper::formatDate($startDate) ?? '' }} - {{ Helper::formatDate($endDate) ?? '' }}]</h4>
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
                      {{ $user->name ?? 'Attendance' }}
                    </span>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body pb-0" data-simplebar="">
              <div class="row flex-nowrap">
                <div class="col">
                  <div class="card primary-gradient">
                    <div class="card-body text-center px-9 pb-4">
                      <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                        <iconify-icon icon="solar:checklist-minimalistic-line-duotone" class="fs-7 text-white"></iconify-icon>
                      </div>
                      <h6 class="fw-normal fs-3 mb-1">Task Status</h6>
                      <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"><span class="">{{ $completedTasks->count() ?? '' }}</span>/<span class="">{{ $totalTasks->count() ?? '' }}</span></h4>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card danger-gradient">
                    <div class="card-body text-center px-9 pb-4">
                      <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                        <iconify-icon icon="solar:checklist-minimalistic-line-duotone" class="fs-7 text-white"></iconify-icon>
                      </div>
                      <h6 class="fw-normal fs-3 mb-1">Pending Tasks</h6>
                      <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">{{ $pendingTasks->count() ?? '' }}</h4>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card secondary-gradient">
                    <div class="card-body text-center px-9 pb-4">
                      <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-secondary flex-shrink-0 mb-3 mx-auto">
                        <iconify-icon icon="ic:outline-backpack" class="fs-7 text-white"></iconify-icon>
                      </div>
                      <h6 class="fw-normal fs-3 mb-1">Task Efficiency</h6>
                      <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">{{ $averageEfficiency ?? '' }}%</h4>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card success-gradient">
                    <div class="card-body text-center px-9 pb-4">
                      <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-success flex-shrink-0 mb-3 mx-auto">
                        <iconify-icon icon="solar:checklist-minimalistic-line-duotone" class="fs-7 text-white"></iconify-icon>
                      </div>
                      <h6 class="fw-normal fs-3 mb-1">Overall Rating</h6>
                      <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">{{ $report->rating ?? '' }}</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <div class="col-md-6">
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
                      <th>Sr No.</th>
                      <th>Date</th>
                      <th>Task Completed</th>
                    </tr>
                    <!-- end row -->
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @forelse($attendances as $data)
                    <tr>
                      <td>{{ $i }}</td>
                      <td>{{ Helper::formatDate($data->date) ?? '' }}</td>
                      <td></td>
                    </tr>
                    @php $i++; @endphp
                    @empty
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-body pb-0" data-simplebar="">
              <div class="row flex-nowrap">
                <div class="col">
                  <div class="card primary-gradient">
                    <div class="card-body text-center px-9 pb-4">
                      <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-primary flex-shrink-0 mb-3 mx-auto">
                        <iconify-icon icon="solar:checklist-minimalistic-line-duotone" class="fs-7 text-white"></iconify-icon>
                      </div>
                      <h6 class="fw-normal fs-3 mb-1">Weekly Working Hrs.</h6>
                      <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1"><span class="">{{ $totalWorkingHours ?? '' }} hrs</span></h4>
                    </div>
                  </div>
                </div>
                <div class="col">
                  <div class="card danger-gradient">
                    <div class="card-body text-center px-9 pb-4">
                      <div class="d-flex align-items-center justify-content-center round-48 rounded text-bg-danger flex-shrink-0 mb-3 mx-auto">
                        <iconify-icon icon="solar:checklist-minimalistic-line-duotone" class="fs-7 text-white"></iconify-icon>
                      </div>
                      <h6 class="fw-normal fs-3 mb-1">Weekly Break Hrs.</h6>
                      <h4 class="mb-3 d-flex align-items-center justify-content-center gap-1">{{ $totalBreakHours ?? '' }} hrs</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @if($report)
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <div class="d-flex mb-1 align-items-center">
                <div>
                  <h4 class="card-title mb-0">Remark</h4>
                </div>
              </div>
              <div class="table-responsive border rounded-1 p-2">
                {!! $report->description ?? '' !!}
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
      
  </div>
@endsection

@section('pagescripts')
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-basic.init.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboards/dashboard3.js') }}"></script>
@endsection