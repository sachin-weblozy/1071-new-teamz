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
            <h4 class="mb-4 mb-md-0 card-title">Import Users</h4>
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
                    Import Users
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
            <h5 class="card-title  mb-0">List of Users to Import</h5>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
              <thead>
                <!-- start row -->
                <tr>
                    <th>Sr No.</th>
                    <th>EmpID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($users as $user)
                <!-- start row -->
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $user['employee_id'] ?? '' }}</td>
                  <td>{{ $user['name'] ?? '' }}</td>
                  <td>{{ $user['email'] ?? '' }}</td>
                  <td>{{ $user['phone'] ?? '' }}</td>
                  <td>{{ $user['department_code'] ?? '' }}</td>
                  <td>
                    <div class="action-btn">
                        <a href="{{ route('admin.crmuser.import',$user['employee_id']) }}"><button class="btn btn-outline-primary btn-sm">Import</button></a>
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
                        <th>EmpID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
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