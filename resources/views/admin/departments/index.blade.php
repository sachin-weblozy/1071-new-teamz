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
            <h4 class="mb-4 mb-md-0 card-title">Departments</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Departments
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
            <h5 class="card-title  mb-0">List of Departments</h5>
            <div class="">
              @can('Department Create')
              <button class="btn btn-primary" id="createDept" data-bs-toggle="modal" data-bs-target="#createmodel" data-toggle="modal" data-target="#createmodel"><i class="las la-plus"></i> Create New</button>
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
                  <th>Code</th>
                  <th>Head</th>
                  <th>Action</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($departments as $department)
                <!-- start row -->
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $department->name ?? '' }}</td>
                  <td>{{ $department->code ?? '' }}</td>
                  <td>{{ $department->head->name ?? '' }}</td>
                  <td>
                    <div class="action-btn">
                        @can('Department Edit')
                          <a href="#" class="text-primary edit ms-2 updatedepartment" data-bs-toggle="modal" data-bs-target="#updatemodel" data-toggle="modal" data-target="#updatemodel" data-id="{{$department->id}}" data-name="{{$department->name}}" data-code="{{$department->code}}" data-head="{{$department->head_id}}">
                            <i class="ti ti-pencil fs-5"></i>
                          </a>
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
                      <th>Code</th>
                      <th>Head</th>
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

@can('Department Create')
<div id="createmodel" class="modal fade" tabindex="-1" aria-labelledby="primary-header-create-task" aria-hidden="true">
  <form action="{{ route('admin.department.store') }}" method="POST">
      @csrf
      <div class="modal-dialog modal-dialog-scrollable modal-lg">
          <div class="modal-content">
              <div class="modal-header modal-colored-header bg-primary text-white">
                  <h4 class="modal-title text-white" id="primary-header-modalLabel">
                      Add Department
                  </h4>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                      <label for="name1">Title</label>
                      <input id="name1" type="text" placeholder="Enter Name" class="form-control" name="name" required>
                      <span class="validation-text">
                          @error('name') <span>{{ $message }}</span> @enderror
                      </span>
                  </div>
                  <div class="form-group">
                      <label for="code1">Code</label>
                      <input id="code1" type="text" placeholder="Enter Code" class="form-control" name="code" required>
                      <span class="validation-text">
                          @error('code') <span>{{ $message }}</span> @enderror
                      </span>
                  </div>
                  <div class="form-group">
                    <label for="head">Select Head</label>
                    <select class="form-control" id="head" name="head">
                      @foreach($users as $user)
                        <option value="{{ $user->id }}" >{{ $user->name }}</option>
                      @endforeach
                    </select>
                    <span class="validation-text">
                        @error('head') <span>{{ $message }}</span> @enderror
                    </span>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                      Close
                  </button>
                  <button type="submit" class="btn bg-primary-subtle text-primary ">
                      Submit
                  </button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
  </form>
</div>
@endcan

@can('Department Edit')
<div id="updatemodel" class="modal fade" tabindex="-1" aria-labelledby="primary-header-update-task" aria-hidden="true">
    <form id="addContactModalTitle" action="{{ route('admin.department.update') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">
                        Edit Department
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        <input type="hidden" id="deptid" name="deptid" value="">
                    </div>
                    <div class="form-group">
                        <label>Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code" name="code" placeholder="Enter code">
                    </div>
                    <div class="form-group">
                      <label for="head">Select Head</label>
                      <select class="form-control" id="head" name="head">
                        @foreach($users as $user)
                          <option value="{{ $user->id }}" >{{ $user->name }}</option>
                        @endforeach
                      </select>
                      <span class="validation-text">
                          @error('head') <span>{{ $message }}</span> @enderror
                      </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn bg-primary-subtle text-primary ">
                        Submit
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>
  @endcan
  <script>
    $(document).on("click", ".updatedepartment", function () {
        var deptId = $(this).data('id');
        var deptName = $(this).data('name');
        var deptCode = $(this).data('code');
        var deptHead = $(this).data('head');
        $(".modal-body #deptid").val(deptId);
        $(".modal-body #name").val(deptName);
        $(".modal-body #code").val(deptCode);
        $(".modal-body #head").val(deptHead);

        // if(catStatus == 1){
        //     $(".modal-body #active").prop("checked", true);
        // }else if(catStatus == 0){
        //     $(".modal-body #inactive").prop("checked", true);
        // }
    });
  </script>
@endsection

@section('pagescripts')
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-basic.init.js') }}"></script>
@endsection