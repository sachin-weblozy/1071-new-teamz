@extends('layouts.master')

@section('pagestyles')
<link rel="stylesheet" href="{{ asset('assets/libs/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-md-0 card-title">Meetings</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Meetings
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
            <h5 class="card-title  mb-0">My Upcoming Meetings</h5>
            <div class="">
                {{-- <button class="btn btn-primary" id="createMeeting" data-bs-toggle="modal" data-bs-target="#createmodel" data-toggle="modal" data-target="#createmodel"><i class="las la-plus"></i> Create New</button> --}}
            </div>
          </div>
          <div class="table-responsive">
            <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
              <thead>
                <!-- start row -->
                <tr>
                  <th>Sr No.</th>
                  <th>URL</th>
                  <th>Title</th>
                  <th>Start At</th>
                  <th>End At</th>
                  <th>Project</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                <!-- end row -->
              </thead>
              <tbody>
                @php $i=1; @endphp
                @foreach($meetings as $meeting)
                <!-- start row -->
                <tr>
                  <td>{{ $i }}</td>
                  <td>
                    @if($meeting->meeting_url)
                    <a href="{{ $meeting->meeting_url ?? '#' }}" target="_blank"><button class="btn btn-primary btn-sm">Join Meeting</button></a>
                    @endif
                  </td>
                  <td>{{ $meeting->title ?? '' }}</td>
                  <td>{{ Helper::getDateTime($meeting->start_at) ?? '' }}</td>
                  <td>{{ Helper::getDateTime($meeting->end_at) ?? '' }}</td>
                  <td>{{ $meeting->project->title ?? '' }}</td>
                  <td><span class="mb-1 badge text-bg-primary">{{ $meeting->status }}</span></td>
                  <td>
                    <div class="action-btn">
                        <span class="mb-1 badge text-bg-primary">{{ $meeting->status }}</span>
                        
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
                        <th>URL</th>
                        <th>Title</th>
                        <th>Start At</th>
                        <th>End At</th>
                        <th>Project</th>
                        <th>Status</th>
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

  <div id="createmodel" class="modal fade" tabindex="-1" aria-labelledby="primary-header-create-task" aria-hidden="true">
    <form action="{{ route('admin.meetings.create') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">
                        Create Meeting
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" placeholder="Enter Meeting Title" class="form-control" name="title" required>
                        <span class="validation-text">
                            @error('title') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">Description</label>
                        <input id="description" type="text" placeholder="Enter Meeting Description" class="form-control" name="description">
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">URL</label>
                        <input id="url" type="text" placeholder="Enter Meeting URL" class="form-control" name="url">
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">Start Time</label>
                        <input type="datetime-local" class="form-control flatpickr flatpickr-input" name="start_at" id="start_at" required>
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">End Time</label>
                        <input type="datetime-local" class="form-control flatpickr flatpickr-input" name="end_at" id="end_at" required>
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="members">Add Members</label>
                        <select name="members[]" id="members" class="select2 form-control" multiple>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
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
@endsection

@section('pagescripts')
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>
<script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatable-basic.init.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/forms/select2.init.js') }}"></script>
@endsection