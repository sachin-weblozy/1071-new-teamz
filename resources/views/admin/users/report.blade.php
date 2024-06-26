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
                          <li class="breadcrumb-item active" aria-current="page"><span>Work Report</span></li>
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
    <div class="row layout-top-spacing">
        <div class="apps-ticket col-xl-12 col-lg-12 col-md-12">
            <div class="row">
                <div class="col-xl-12 col-md-12 layout-spacing">
                    <div class="widget-content searchable-container grid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-box">
                                    <div class="">
                                        <h5 class="header-title mb-3 d-inline">{{ $user->name }}'s Work Report - {{ $timereport->created_at->format('d M, Y') ?? '' }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="notifications-table-widget">
                        <div class="widget-heading">
                            <h5 class="">Attendance</h5>
                        </div>
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><div class="th-content">Signed In At</div></th>
                                            <th><div class="th-content">Lunch Break Start</div></th>
                                            <th><div class="th-content">Lunch Break End</div></th>
                                            <th><div class="th-content">Signed Out At</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($timereport)
                                        <tr>
                                            <td>{{ Helper::formatTime($timereport->sign_in) ?? '' }}</td>
                                            <td>{{ Helper::formatTime($timereport->break_start) ?? '' }}</td>
                                            <td>{{ Helper::formatTime($timereport->break_end) ?? '' }}</td>
                                            <td>{{ Helper::formatTime($timereport->sign_out) ?? '' }}</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="notifications-table-widget mt-4">
                        <div class="widget-heading">
                            <h5 class="">Completed Tasks</h5>
                        </div>
                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th><div class="th-content">Title</div></th>
                                            <th><div class="th-content">Deadline</div></th>
                                            <th><div class="th-content">Completed At</div></th>
                                            <th><div class="th-content">Priority</div></th>
                                            <th><div class="th-content">Assigned By</div></th>
                                            <th><div class="th-content">Space</div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($completedtasks as $task)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    {{ $task->title }}
                                                </div>
                                            </td>
                                            <td style="">{{ date('d M, y - h:ma', strtotime($task->deadline)) ?? '' }}</td>
                                            <td style="">{{ date('h:m a', strtotime($task->completed_at)) ?? '' }}</td>
                                            <td>
                                                @if($task->priority == 1)
                                                <span class="badge badge-danger light font-10">High</span>
                                                @elseif($task->priority == 2)
                                                <span class="badge badge-warning light font-10">Medium</span>
                                                @elseif($task->priority == 3)
                                                <span class="badge badge-success-teal light font-10">Low</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $task->assignedby->name }}
                                            </td>
                                            <td>
                                                @if($task->space != null)
                                                <span class="badge badge-secondary light font-10">{{ $task->space->name }}</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @empty 
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="notifications-table-widget mt-4">
                        <div class="widget-heading">
                            <h5 class="">Notes</h5>
                        </div>
                        <div class="widget-content p-2 text-black">
                            {!! $timereport->notes !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection