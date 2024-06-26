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
              <h4 class="mb-4 mb-md-0 card-title">{{ $user->name }}'s Report</h4>
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

    @if($type=='daily')
    <div class="datatables">
      <!-- start File export -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
            <h5 class="card-title  mb-0">Weekly Work Report</h5>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
              <thead>
                <!-- start row -->
                <tr>
                    <th>Sr No.</th>
                    <th>Start of Week</th>
                    <th>Action</th>
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
                  <td>
                    <div class="action-btn">
                        @if($data->sign_out != null)
                        <a href="{{ route('admin.report', ['encuserId' => encrypt($user->id), 'encdate' => encrypt($data->date)]) }}"><button class="btn btn-outline-primary btn-sm">Report</button></a>
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
                        <th>Start of Week</th>
                        <th>Action</th>
                    </tr>
                    <!-- end row -->
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if($type=='weekly')
    <div class="datatables">
      <!-- start File export -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
            <h5 class="card-title  mb-0">Weekly Work Report</h5>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
              <thead>
                <!-- start row -->
                <tr>
                    <th>Sr No.</th>
                    <th>Start of Week</th>
                    <th>Action</th>
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
                  <td>
                    <div class="action-btn">
                      @if($data->sign_out != null)
                      <a href="{{ route('admin.userreport.weekly.show', ['userid' => encrypt($user->id), 'date' => encrypt($data->date)]) }}"><button class="btn btn-outline-primary btn-sm">Report</button></a>
                      @endif
                      {{-- @if($isFriday==true) --}}
                        @if($access==true)
                        <button class="btn btn-outline-danger btn-sm" id="createTask" data-bs-toggle="modal" data-bs-target="#createmodel{{ $data->id }}" data-toggle="modal" data-target="#createmodel{{ $data->id }}"><i class="las la-plus"></i> Update Rating</button>
                        <div id="createmodel{{ $data->id }}" class="modal fade" tabindex="-1" aria-labelledby="primary-header-create-task" aria-hidden="true">
                          <form action="{{ route('admin.userreport.store') }}" method="POST">
                              @csrf
                              <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                  <div class="modal-content">
                                      <div class="modal-header modal-colored-header bg-primary text-white">
                                          <h4 class="modal-title text-white" id="primary-header-modalLabel">
                                            Update Rating
                                          </h4>
                                          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="form-group mt-3">
                                              <input type="hidden" name="userid" value="{{ $user->id }}">
                                              <input type="hidden" name="type" value="weekly">
                                              <input type="hidden" name="start_date" value="{{ $data->date }}">
                                              <label for="task">Rating</label>
                                              <select name="rating" class="form-control"  id="rating">
                                                  <option value="Bronze">Bronze</option>
                                                  <option value="Silver">Silver</option>
                                                  <option value="Gold">Gold</option>
                                              </select>
                                              <span class="validation-text">
                                                  @error('rating') <span>{{ $message }}</span> @enderror
                                              </span>
                                          </div>
                                          <div class="form-group mt-3">
                                            <label for="task">Rating</label>
                                            <label for="description">Enter Description</label>
                                            <textarea id="mymce1" name="description" ></textarea>
                                            <span class="validation-text">
                                                @error('rating') <span>{{ $message }}</span> @enderror
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
                        @endif
                      {{-- @endif --}}
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
                        <th>Start of Week</th>
                        <th>Action</th>
                    </tr>
                    <!-- end row -->
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endif

    @if($type=='monthly')
    <div class="datatables">
      <!-- start File export -->
      <div class="card">
        <div class="card-body">
          <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
            <h5 class="card-title  mb-0">Weekly Work Report</h5>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
              <thead>
                <!-- start row -->
                <tr>
                    <th>Sr No.</th>
                    <th>Start of Week</th>
                    <th>Action</th>
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
                  <td>
                    <div class="action-btn">
                        @if($data->sign_out != null)
                        <a href="{{ route('admin.report', ['encuserId' => encrypt($user->id), 'encdate' => encrypt($data->date)]) }}"><button class="btn btn-outline-primary btn-sm">Report</button></a>
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
                        <th>Start of Week</th>
                        <th>Action</th>
                    </tr>
                    <!-- end row -->
                </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endif

  </div>
@endsection

@section('pagescripts')
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-basic.init.js') }}"></script>
@endsection