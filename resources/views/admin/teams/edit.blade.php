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
            <h4 class="mb-4 mb-md-0 card-title">Teams</h4>
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
                    Edit
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
        <div class="px-4 py-3 border-bottom">
          <h4 class="card-title mb-0">Edit Team</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.teams.update',$team->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Team Name" value="{{ old('name') ?? $team->name }}" required>
                </div>
                <div class="mb-4">
                    <label for="department" class="form-label">Assign Department</label>
                    @php
                        $selectedDepts = $team->dept->pluck('id')->toArray();
                    @endphp
                    <select class="form-control" id="department" name="department">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @if($department->id == $team->department_id) selected @endif>{{ $department->code }} - {{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="members" class="form-label">Manage Members</label>
                    @php
                        $selectedUsers = $team->users->pluck('id')->toArray();
                    @endphp
                    <select class="select2 form-control" id="members" name="members[]" multiple="multiple">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @selected(in_array($user->id, old('users', $selectedUsers)))>{{ $user->employee_id }} - {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                  <label for="lead" class="form-label">Team Lead</label>
                  @php
                      $selectedUsers = $team->users->pluck('id')->toArray();
                  @endphp
                  <select class="form-control" id="lead" name="lead">
                      @foreach($team->users as $user)
                        @if(in_array($user->id, old('users', $selectedUsers)))
                          <option value="{{ $user->id }}" @if($user->id == $team->lead_id) selected @endif>{{ $user->employee_id }} - {{ $user->name }}</option>
                        @endif
                      @endforeach
                  </select>
              </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    
  </div>
@endsection

@section('pagescripts')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/forms/select2.init.js') }}"></script>
@endsection