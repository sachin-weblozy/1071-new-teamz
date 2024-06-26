@extends('layouts.master')
   
@section('content')
<div class="sub-header-container">
  <header class="header navbar navbar-expand-sm">
      <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
          <i class="las la-bars"></i>
      </a>
      <ul class="navbar-nav flex-row">
          <li>
              <div class="page-header">
                  <nav class="breadcrumb-one" aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0);">Dashboard</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><span>Projects</span></li>
                      </ol>
                  </nav>
              </div>
          </li>
      </ul>
  </header>
</div>
<!--  Navbar Ends / Breadcrumb Area  -->
<!-- Main Body Starts -->
<div class="layout-px-spacing">
    <div class="layout-top-spacing mb-2">
        <div class="col-md-12">
            <div class="row">
                <div class="container-fluid">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">
                            <form action="{{ route('admin.projects.update',$project->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="statbox widget box box-shadow mb-4">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <div class="makeitSticky z">
                                                <h4>Edit Project</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-content">
                                    <div class="col-xl-12 col-md-12 col-sm-12 col-12 ml-2">
                                        <div class="mt-2">
                                            <div class="form-group row">
                                                <label class="col-3">Title</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-solid" type="text" name="title" value="{{ $project->title ?? '' }}" placeholder="Project Title" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3">URL</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-solid" type="text" name="url" value="{{ $project->url ?? '' }}" placeholder="URL" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3">Requirements</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-solid" type="text" name="requirement" value="{{ $project->requirement ?? '' }}" placeholder="Requirements" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3">Project Deadline</label>
                                                <div class="col-9">
                                                    <input class="form-control form-control-solid" type="date" name="deadline"  value="{{ date('Y-m-d', strtotime($project->deadline)) ?? '' }}" placeholder="Requirements" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3">Assign Department</label>
                                                <div class="col-9">
                                                    @php
                                                        $selectedDepts = $project->departments->pluck('id')->toArray();
                                                    @endphp
                                                    <select name="department[]" class="form-control form-control-solid multiple" multiple="multiple">
                                                        {{-- <option value="" selected disabled>Select Department</option> --}}
                                                        @foreach($departments as $department)
                                                        <option value="{{ $department->id }}" @selected(in_array($department->id, old('departments', $selectedDepts)))>{{ $department->code }} - {{ $department->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-3">Allot Users</label>
                                                <div class="col-9">
                                                    @php
                                                        $selectedUsers = $project->users->pluck('id')->toArray();
                                                    @endphp
                                                    <select name="user[]" id="" class="form-control form-control-solid multiple" multiple="multiple">
                                                        {{-- <option value="" selected disabled>Select Department</option> --}}
                                                        @foreach($users as $user)
                                                        <option value="{{ $user->id }}" @selected(in_array($user->id, old('users', $selectedUsers)))>{{ $user->employee_id }} - {{ $user->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- @if($project->teamlead) --}}
                                            <div class="form-group row">
                                                <label class="col-3">Teamlead</label>
                                                <div class="col-9">
                                                    <select name="teamlead" id="" class="form-control form-control-solid">
                                                        <option value="" selected disabled>Select Teamlead</option>
                                                        @foreach($users as $user)
                                                        @if(in_array($user->id, old('users', $selectedUsers)))
                                                            <option value="{{ $user->employee_id }}" @if($user->employee_id == $project->teamlead) selected @endif>{{ $user->name }}</option>
                                                        @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-footer text-right">
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-primary">Cancel</a>
                                </div>
                            </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection