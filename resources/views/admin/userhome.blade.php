@extends('layouts.master')
 
  @section('pagestyles')

  @endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    {{-- <div class="mb-2">
      @livewire('attendance-recorder')
    </div> --}}

    <div class="col-lg-4">
      <!-- -------------------------------------------- -->
      <!-- Welcome Card -->
      <!-- -------------------------------------------- -->
      <div class="card bg-primary-gt text-white overflow-hidden shadow-none">
        <div class="card-body position-relative z-1">
          <div class="row justify-content-between align-items-center">
            <div class="col-sm-7">
              <h5 class="fw-semibold mb-9 fs-7 text-white">{{ $dayMsg1 ?? '' }}</h5>
            </div>
            <p class="mb-9 ">{{ $dayMsg2 ?? '' }}</p>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body p-4">
          <h4 class="card-title">Upcoming Meetings</h4>
          <div class="position-relative">
            @forelse ($meetings as $meeting)
            <div class="d-flex align-items-center justify-content-between my-4">
              <div class="d-flex">
                <div class="p-8 bg-primary-subtle rounded-1 d-flex align-items-center justify-content-center me-6">
                  <img src="../assets/images/svgs/icon-screen-share.svg" alt="matdash-img" class="img-fluid" width="24" height="24">
                </div>
                <div>
                  <h6 class="mb-1 fs-4 fw-semibold">{{ $meeting->title }}</h6>
                  <p class="fs-3 mb-0">{{ Helper::getDateTime($meeting->start_at) }}</p>
                </div>
              </div>
              @if($meeting->meeting_url)<h6 class="mb-0 text-muted"><a href="" class="btn btn-outline-primary btn-sm">Join</a></h6>@endif
            </div>
            @empty
                No meetings, you are all set!
            @endforelse
          </div>
        </div>
      </div>

      @livewire('task-manager')

    </div>
    <div class="col-lg-4">
      @livewire('weather')
      
    </div>

    <div class="col-lg-4">

      <div class="card">
        <div class="card-body text-center">
          @if($report)
            @if($report->rating=='Gold')
            <img src="{{ 'assets/images/backgrounds/gold.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
            <h5 class="fw-semibold fs-5 mb-2">Gold</h5>
            <p class="mb-3 px-xl-5">Congratulations, You got gold medal last week.</p>
            @endif
            @if($report->rating=='Silver')
            <img src="{{ 'assets/images/backgrounds/silver.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
            <h5 class="fw-semibold fs-5 mb-2">Silver</h5>
            <p class="mb-3 px-xl-5">Congratulations, You got silver medal last week.</p>
            @endif
            @if($report->rating=='Bronze')
            <img src="{{ 'assets/images/backgrounds/bronze.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
            <h5 class="fw-semibold fs-5 mb-2">Bronze</h5>
            <p class="mb-3 px-xl-5">Congratulations, You got bronze medal last week.</p>
            @endif

          @else 
          <img src="{{ 'assets/images/backgrounds/medal.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
          <h5 class="fw-semibold fs-5 mb-2">Get Awarded</h5>
          <p class="mb-3 px-xl-5">Work hard to get awarded.</p>
          @endif
        </div>
      </div>

      <div class="card poll-widget">
        <div class="card-body">
          <h4 class="card-title">My Projects</h4>
          <p class="fw-bold text-muted">
            {{-- What is your mobile app usage daily? --}}
          </p>
          <ul class="list-style-none mt-3 mb-2">
            @forelse ($projects as $project)
            <li class="mt-4">
              <div class="d-flex align-items-center">
                <div>
                  <h6 class="mb-0 fw-bold">
                    {{ $project->title ?? '' }}
                  </h6>
                </div>
                <div class="ms-auto">
                  <h6 class="mb-0 fw-bold">{{ $project->progress ?? '' }}%</h6>
                </div>
              </div>
              <div class="progress mt-2 text-bg-light">
                <div class="progress-bar bg-cyan" role="progressbar" style="width: {{ $project->progress ?? '' }}%" aria-valuenow="{{ $project->progress ?? '' }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </li>
            @empty
                
            @endforelse
          </ul>
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