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
            <h4 class="mb-4 mb-md-0 card-title">Team Details</h4>
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
                    Members
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    @forelse($teams as $team)
    <div class="col-sm-6 col-lg-6">
      <div class="card hover-img">
        <div class="card-body p-4 text-center border-bottom">
          <a href="{{ route('admin.myteam.show',encrypt($team->id)) }}"><h5 class="fw-semibold mb-0">{{ $team->name ?? '' }}</h5></a>
          <span class="text-dark fs-2">Members: {{ $team->users->count() }}</span>
        </div>
        
        <ul class="hstack mb-0 pt-1 d-flex align-items-center justify-content-center">
            @forelse($team->users as $member)
            <li class="ms-n8">
              <a href="javascript:void(0)" class="me-1">
                <img src="{{ asset($member->profile_photo_url) ?? '' }}" class="rounded-circle border border-2 border-white my-2 mx-auto" width="35" height="35" alt="user-img">
              </a>
            </li>
            @empty 
            @endforelse
          </ul>
      </div>
    </div>
    @empty 
    {{-- No space found --}}
    @endforelse

    
  </div>
@endsection

@section('pagescripts')
    <script src="{{ asset('assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/forms/select2.init.js') }}"></script>
@endsection