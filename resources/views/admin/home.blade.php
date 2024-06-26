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

      @php $i=1; @endphp
      <div class="card" style="height:400px; overflow-y:auto;">
        <div class="card-body">
          
          <h4 class="card-title mb-3">User Based Tasks</h4>
          <div id="carouselExampleControls" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach($users as $user)
                
                <div class="carousel-item @if($i==1) active @endif">
                  <h5 class="card-title mb-3">{{ $user->name ?? '' }}</h5>
                  @forelse($user->getTodayTasks as $task)
                  <li class="list-group-item todo-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                    <div class="form-check">
                      <div>
                          <h5 class="todo-desc mb-0 fs-3 fw-medium mt-n1">
                            @if($task->deadline < $now)
                            <span class="text-danger fw-bold">{{ $task->title ?? '' }}</span>
                            @else 
                            <span class="fw-bold">{{ $task->title ?? '' }}</span>
                            @endif    
                          </h5>
                          <div class="todo-desc text-muted fw-normal fs-2">
                            {{ Helper::getDateTime($task->deadline) ?? '' }}
                          </div>
                        </div>
                      </label>
                    </div>
                  </li>
                  @empty 
                    No Task Found
                  @endforelse
                </div>
                @php $i++; @endphp
                
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
          
        </div>
      </div>

    </div>
    <div class="col-lg-4">
      @livewire('weather')
      
    </div>

    <div class="col-lg-4">

      @php $j=1; @endphp
      <div class="card" >
        <div class="card-body text-center">
          
          {{-- <h4 class="card-title mb-3">User Based Tasks</h4> --}}
          <div id="carouselExampleControls1" class="carousel slide carousel-dark" data-bs-ride="carousel">
            <div class="carousel-inner">
              @foreach($users as $user)
                
                <div class="carousel-item @if($j==1) active @endif">
                  <h5 class="card-title mb-3">{{ $user->name ?? '' }}</h5>
                  
                  @if($user->lastReport)
                    @if($user->lastReport->rating=='Gold')
                    <img src="{{ 'assets/images/backgrounds/gold.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
                    <h5 class="fw-semibold fs-5 mb-2">Gold</h5>
                    @endif
                    @if($user->lastReport->rating=='Silver')
                    <img src="{{ 'assets/images/backgrounds/silver.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
                    <h5 class="fw-semibold fs-5 mb-2">Silver</h5>
                    @endif
                    @if($user->lastReport->rating=='Bronze')
                    <img src="{{ 'assets/images/backgrounds/bronze.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
                    <h5 class="fw-semibold fs-5 mb-2">Bronze</h5>
                    @endif
                    <p class="mb-3 px-xl-5">{{ Helper::formatDate($user->lastReport->start_date) ?? '' }}</p>
                  @else 
                  <img src="{{ 'assets/images/backgrounds/medal.png' }}" alt="medal-img" class="img-fluid mb-4" width="150">
                  <h5 class="fw-semibold fs-5 mb-2">Get Awarded</h5>
                  <p class="mb-3 px-xl-5">Work hard to get awarded.</p>
                  @endif
                </div>
                @php $j++; @endphp
                
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls1" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls1" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
          </div>
          
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