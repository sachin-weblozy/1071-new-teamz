@extends('layouts.master')
@section('pagestyles')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-md-0 card-title">Profile</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="../main/index.html">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Profile
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <ul class="nav nav-pills user-profile-tab" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-account-tab" data-bs-toggle="pill" data-bs-target="#pills-account" type="button" role="tab" aria-controls="pills-account" aria-selected="true">
            <i class="ti ti-user-circle me-2 fs-6"></i>
            <span class="d-none d-md-block">Account</span>
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-3" id="pills-security-tab" data-bs-toggle="pill" data-bs-target="#pills-security" type="button" role="tab" aria-controls="pills-security" aria-selected="false">
            <i class="ti ti-lock me-2 fs-6"></i>
            <span class="d-none d-md-block">Security</span>
          </button>
        </li>
      </ul>
      <div class="card-body">
        <div class="tab-content" id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab" tabindex="0">
            <div class="row">

              @if (Laravel\Fortify\Features::canUpdateProfileInformation())
              <div class="col-lg-12 d-flex align-items-stretch">
                <div class="card w-100 border position-relative overflow-hidden">
                  @livewire('profile.update-profile-information-form')
                </div>
              </div>
              @endif
                
            </div>
          </div>
          <div class="tab-pane fade" id="pills-security" role="tabpanel" aria-labelledby="pills-security-tab" tabindex="0">
            <div class="row">

              @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="col-lg-6 d-flex align-items-stretch">
                  <div class="card w-100 border position-relative overflow-hidden">
                    <div class="card-body p-4">
                      <h4 class="card-title">Change Password</h4>
                      <p class="card-subtitle mb-4">To change your password please confirm here</p>
                      @livewire('profile.update-password-form')
                    </div>
                  </div>
                </div>
              @endif
              
              <div class="col-lg-6">
                <div class="card border position-relative overflow-hidden">
                    @livewire('profile.logout-other-browser-sessions-form')
                </div>
              </div>

              @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
              <div class="col-lg-12">
                <div class="card border shadow-none">
                      @livewire('profile.two-factor-authentication-form')
                  </div>
                </div>
              @endif

              @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <div class="col-lg-12 d-flex align-items-stretch">
                  <div class="card w-100 border position-relative overflow-hidden">
                    @livewire('profile.delete-user-form')
                  </div>
                </div>
              @endif
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('pagescripts')
<script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/js/dashboards/dashboard1.js') }}"></script>
<script src="{{ asset('assets/libs/fullcalendar/index.global.min.js') }}"></script>
@endsection