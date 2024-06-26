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
                          <li class="breadcrumb-item active" aria-current="page"><span>{{ $user->name }}'s Calendar</span></li>
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
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
        <div class="col-lg-12">
            <div class="">
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalCenterTitle">Task Details</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <i class="las la-times"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="modal-text" id="modelData"></p>
                            </div>
                            <div class="modal-footer">
                                <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
    
    var SITEURL = "{{ url('/') }}";
    
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    var calendar = $('#calendar').fullCalendar({
            editable: true,
            events: @json($events),
            displayEventTime: false,
            editable: true,
            eventRender: function (event, element, view) {
                if (event.allDay === 'true') {
                        event.allDay = true;
                } else {
                        event.allDay = false;
                }
            },
            selectable: true,
            selectHelper: true,
            // select: function (start, end, allDay) {
            //     var title = prompt('Event Title:');
            //     if (title) {
            //         var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
            //         var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
            //         $.ajax({
            //             url: SITEURL + "/fullcalenderAjax",
            //             data: {
            //                 title: title,
            //                 start: start,
            //                 end: end,
            //                 type: 'add'
            //             },
            //             type: "POST",
            //             success: function (data) {
            //                 displayMessage("Event Created Successfully");

            //                 calendar.fullCalendar('renderEvent',
            //                     {
            //                         id: data.id,
            //                         title: title,
            //                         start: start,
            //                         end: end,
            //                         allDay: allDay
            //                     },true);

            //                 calendar.fullCalendar('unselect');
            //             }
            //         });
            //     }
            // },
            // eventDrop: function (event, delta) {
            //     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
            //     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

            //     $.ajax({
            //         url: SITEURL + '/fullcalenderAjax',
            //         data: {
            //             title: event.title,
            //             start: start,
            //             end: end,
            //             id: event.id,
            //             type: 'update'
            //         },
            //         type: "POST",
            //         success: function (response) {
            //             displayMessage("Event Updated Successfully");
            //         }
            //     });
            // },
            eventClick: function (event) {
                document.getElementById('modelData').textContent = event.title;
                $('#exampleModalCenter').modal('show');
            }

        });
    
    });
    
    function displayMessage(message) {
        toastr.success(message, 'Event');
    } 
  
</script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
@endsection