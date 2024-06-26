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
            <h4 class="mb-4 mb-md-0 card-title">Spaces</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item d-flex align-items-center">
                    <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.spaces.index') }}">
                        <span class="badge fw-medium fs-2 bg-primary-subtle text-muted">
                            Spaces
                        </span>
                    </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Members
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
          <h4 class="card-title mb-0">Adding members to {{ $space->name }}</h4>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('admin.spaces.storemembers') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <input type="hidden" name="spaceid" value="{{ $space->id }}">
                    @php
                        $selectedMembers = $space->users->pluck('id')->toArray();
                    @endphp
                    <label for="members" class="form-label">Allot Users</label>
                    <select class="select2 form-control" id="members" name="members[]" multiple="multiple">
                        @foreach($project->users as $user)
                            <option value="{{ $user->id }}" @selected(in_array($user->id, old('users', $selectedMembers)))>{{ $user->name }}</option>
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