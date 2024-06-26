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
            <h4 class="mb-4 mb-md-0 card-title">My Attendances</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    My Attendances
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
            <h5 class="card-title  mb-0">My Attendance</h5>
            <div class="">
              
            </div>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
              <thead>
                <!-- start row -->
                <tr>
                  <th>Sr No.</th>
                  <th>Date</th>
                  <th>SignIn At</th>
                  <th>Break Start At</th>
                  <th>Break End At</th>
                  <th>SignOut At</th>
                  <th>Report</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($attendances as $data)
                <!-- start row -->
                <tr>
                  <td>{{ $i }}</td>
                    <td>{{ Helper::formatDate($data->date) ?? '' }}</td>
                    <td>{{ Helper::formatTime($data->sign_in) ?? '' }}</td>
                    <td>{{ Helper::formatTime($data->break_start) ?? '' }}</td>
                    <td>{{ Helper::formatTime($data->break_end) ?? '' }}</td>
                    <td>{{ Helper::formatTime($data->sign_out) ?? '' }}</td>
                    <td>
                        <div class="action-btn">
                            @if($data->sign_out != null)
                            <a href="{{ route('admin.report', ['encuserId' => encrypt(Auth::id()), 'encdate' => encrypt($data->date)]) }}"><button class="btn btn-outline-primary btn-sm">Report</button></a>
                            @endif
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
                        <th>Date</th>
                        <th>SignIn At</th>
                        <th>Break Start At</th>
                        <th>Break End At</th>
                        <th>SignOut At</th>
                        <th>Report</th>
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