@extends('layouts.master')

@section('pagestyles')

@endsection

@section('content')
<div class="container-fluid">
    <div class="card card-body py-3">
      <div class="row align-items-center">
        <div class="col-12">
          <div class="d-sm-flex align-items-center justify-space-between">
            <h4 class="mb-4 mb-md-0 card-title">Calendar</h4>
            <nav aria-label="breadcrumb" class="ms-auto">
              <ol class="breadcrumb">
                <li class="breadcrumb-item d-flex align-items-center">
                  <a class="text-muted text-decoration-none d-flex" href="{{ route('admin.dashboard') }}">
                    <iconify-icon icon="solar:home-2-line-duotone" class="fs-6"></iconify-icon>
                  </a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                  <span class="badge fw-medium fs-2 bg-primary-subtle text-primary">
                    Calendar
                  </span>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <div class="card">
      <div class="card-body calender-sidebar app-calendar">
        <div id="calendar"></div>
      </div>
    </div>
      <!-- BEGIN MODAL -->
      {{-- <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="eventModalLabel">
                Add / Edit Event
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div>
                    <label class="form-label">Event Title</label>
                    <input id="event-title" type="text" class="form-control" />
                  </div>
                </div>
                <div class="col-md-12 mt-6">
                  <div>
                    <label class="form-label">Event Color</label>
                  </div>
                  <div class="d-flex">
                    <div class="n-chk">
                      <div class="form-check form-check-primary form-check-inline">
                        <input class="form-check-input" type="radio" name="event-level" value="Danger" id="modalDanger" />
                        <label class="form-check-label" for="modalDanger">Danger</label>
                      </div>
                    </div>
                    <div class="n-chk">
                      <div class="form-check form-check-warning form-check-inline">
                        <input class="form-check-input" type="radio" name="event-level" value="Success" id="modalSuccess" />
                        <label class="form-check-label" for="modalSuccess">Success</label>
                      </div>
                    </div>
                    <div class="n-chk">
                      <div class="form-check form-check-success form-check-inline">
                        <input class="form-check-input" type="radio" name="event-level" value="Primary" id="modalPrimary" />
                        <label class="form-check-label" for="modalPrimary">Primary</label>
                      </div>
                    </div>
                    <div class="n-chk">
                      <div class="form-check form-check-danger form-check-inline">
                        <input class="form-check-input" type="radio" name="event-level" value="Warning" id="modalWarning" />
                        <label class="form-check-label" for="modalWarning">Warning</label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12 mt-6">
                  <div>
                    <label class="form-label">Enter Start Date</label>
                    <input id="event-start-date" type="datetime" class="form-control" />
                  </div>
                </div>

                <div class="col-md-12 mt-6">
                  <div>
                    <label class="form-label">Enter End Date</label>
                    <input id="event-end-date" type="datetime" class="form-control" />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" class="btn btn-success btn-update-event" data-fc-event-public-id="">
                Update changes
              </button>
              <button type="button" class="btn btn-primary btn-add-event">
                Add Event
              </button>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- END MODAL -->
  </div>
  
@endsection

@section('pagescripts')
<script src="{{ 'assets/libs/fullcalendar/index.global.min.js' }}"></script>
<script src="{{ 'assets/js/apps/calendar-init.js' }}"></script>
@endsection