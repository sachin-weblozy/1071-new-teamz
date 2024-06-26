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
            <h4 class="mb-4 mb-md-0 card-title">Projects</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item d-flex align-items-center">
                    <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.projects.index') }}">
                        <span class="badge fw-medium fs-2 bg-primary-subtle text-muted">
                            Projects
                        </span>
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Create
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
          <h4 class="card-title mb-0">Edit Project</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.projects.update',$project->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Project Title" value="{{ old('title') ?? $project->title }}" required>
                </div>
                <div class="mb-4">
                    <label for="url" class="form-label">URL</label>
                    <input type="text" class="form-control" id="url" name="url" placeholder="Project URL" value="{{ old('url') ?? $project->url }}">
                </div>
                <div class="mb-4">
                    <label for="mymce" class="form-label">Requirements</label>
                    <textarea id="mymce" name="requirement">{{ old('requirement') ?? $project->requirement }}</textarea>
                </div>
                <div class="mb-4">
                    <label for="deadline" class="form-label">Deadline</label>
                    <input type="date" class="form-control" id="deadline" name="deadline" placeholder="Project URL" value="{{ old('deadline') ?? date('Y-m-d', strtotime($project->deadline)) }}" required>
                </div>
                <div class="mb-4">
                    <label for="department" class="form-label">Assign Department</label>
                    @php
                        $selectedDepts = $project->departments->pluck('id')->toArray();
                    @endphp
                    <select class="select2 form-control" id="department" name="department[]" multiple="multiple">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" @selected(in_array($department->id, old('departments', $selectedDepts)))>{{ $department->code }} - {{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="users" class="form-label">Allot Users</label>
                    @php
                        $selectedUsers = $project->users->pluck('id')->toArray();
                    @endphp
                    <select class="select2 form-control" id="users" name="user[]" multiple="multiple">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @selected(in_array($user->id, old('users', $selectedUsers)))>{{ $user->employee_id }} - {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                  <label for="users" class="form-label">Project Lead</label>
                  @php
                      $selectedUsers = $project->users->pluck('id')->toArray();
                  @endphp
                  <select class="form-control" id="teamlead" name="teamlead">
                      @foreach($users as $user)
                        @if(in_array($user->id, old('users', $selectedUsers)))
                          <option value="{{ $user->id }}" @if($user->id == $project->teamlead) selected @endif>{{ $user->employee_id }} - {{ $user->name }}</option>
                        @endif
                      @endforeach
                  </select>
              </div>

              <div class="mb-4">
                <label for="progress" class="form-label">Progress (%)</label>
                <input type="number" class="form-control" id="progress" name="progress" value="{{ old('progress') ?? $project->progress }}" placeholder="0 to 100 only">
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