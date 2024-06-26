<div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Meetings <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $meetings->count() }}</span>
    </h3>
    {{-- <form class="position-relative">
      <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Followers">
      <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
    </form> --}}
</div>

<div class="datatables">
    <!-- start File export -->
    <div class="card">
      <div class="card-body">
        <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
          <h5 class="card-title  mb-0">List of Meetings</h5>
          <div class="">
            <button class="btn btn-primary" id="createMeeting" data-bs-toggle="modal" data-bs-target="#createmodel" data-toggle="modal" data-target="#createmodel"><i class="las la-plus"></i> Create New</button>
          </div>
        </div>
        <div class="table-responsive">
          <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
            <thead>
              <!-- start row -->
              <tr>
                <th>Sr No.</th>
                <th>Meeting URL</th>
                <th>Title</th>
                <th>Start At</th>
                <th>End At</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              <!-- end row -->
            </thead>
            <tbody>
              @php $i=1; @endphp
              @foreach($meetings as $meeting)
              <!-- start row -->
              <tr>
                <td>{{ $i }}</td>
                <td>
                    @if($meeting->meeting_url)
                    <a href="{{ $meeting->meeting_url ?? '#' }}" target="_blank"><button class="btn btn-primary btn-sm">Join Meeting</button></a>
                    @endif
                </td>
                <td>{{ $meeting->title ?? '' }}</td>
                <td>{{ Helper::getDateTime($meeting->start_at) ?? '' }}</td>
                <td>{{ Helper::getDateTime($meeting->end_at) ?? '' }}</td>
                <td><span class="mb-1 badge text-bg-info">{{ $meeting->status ?? '' }}</span></td>
                <td>
                  <div class="action-btn">
                      <a type="button" class="meetingdetail text-primary view ms-2" data-bs-toggle="modal" data-bs-target="#detailmodel" data-toggle="modal" data-target="#detailmodel" data-data="{{$meeting}}">
                        <i class="ti ti-eye fs-5"></i>
                      </a>
                      <a type="button" class="meetingnotes text-primary view ms-2" data-bs-toggle="modal" data-bs-target="#meetingnotes" data-toggle="modal" data-target="#meetingnotes" data-data="{{$meeting}}">
                        <i class="ti ti-calendar-stats fs-5"></i>
                      </a>
                      {{-- <a href="{{ route('admin.projects.edit', $project->id) }}" class="text-primary edit ms-2">
                          <i class="ti ti-pencil fs-5"></i>
                        </a> --}}
                        <a type="button" class="text-dark delete ms-2" onclick="event.preventDefault(); document.getElementById('delete-form{{ $meeting->id }}').submit();">
                          <i class="ti ti-trash fs-5"></i>
                        </a>
                      <form id="delete-form{{ $meeting->id }}" action="{{ route('admin.projects.meeting.destroy', $meeting->id) }}" method="POST" class="d-none">
                          @csrf
                          @method('delete')
                      </form>
                    </div>
                </td>
              </tr>
              <!-- end row -->
              @php $i++; @endphp
              @endforeach
              <tfoot>
                  <!-- start row -->
                  <tr>
                      <th>Sr No.</th>
                      <th>Meeting URL</th>
                      <th>Title</th>
                      <th>Start At</th>
                      <th>End At</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                  <!-- end row -->
              </tfoot>
          </table>
        </div>
      </div>
    </div>
</div>

<div id="createmodel" class="modal fade" tabindex="-1" aria-labelledby="primary-header-create-task" aria-hidden="true">
    <form action="{{ route('admin.projects.createMeeting') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">
                        Create Meeting
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input id="title" type="text" placeholder="Enter Meeting Title" class="form-control" name="title" required>
                        <input type="hidden" name="project_id" value="{{ $project->id }}">
                        <span class="validation-text">
                            @error('title') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">Description</label>
                        <input id="description" type="text" placeholder="Enter Meeting Description" class="form-control" name="description">
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">URL</label>
                        <input id="url" type="text" placeholder="Enter Meeting URL" class="form-control" name="url">
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">Start Time</label>
                        <input type="datetime-local" class="form-control flatpickr flatpickr-input" name="start_at" id="start_at" required>
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="task">End Time</label>
                        <input type="datetime-local" class="form-control flatpickr flatpickr-input" name="end_at" id="end_at" required>
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                    <div class="form-group mt-3">
                        <label for="members">Add Members</label>
                        <select name="members[]" id="members" class="select2 form-control" multiple>
                            @foreach($project->users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <span class="validation-text">
                            @error('deadline') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn bg-primary-subtle text-primary ">
                        Submit
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>

<div id="meetingnotes" class="modal fade" tabindex="-1" aria-labelledby="primary-header-create-task" aria-hidden="true">
    <form action="{{ route('admin.projects.meetingNotes') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">
                        Meeting Notes
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="mymce1">Notes</label>
                        <textarea id="mymce1" name="notes"></textarea>
                        <input id="meeting_id" type="hidden" name="meeting_id">
                        <span class="validation-text">
                            @error('notes') <span>{{ $message }}</span> @enderror
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn bg-primary-subtle text-primary ">
                        Submit
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>

<div id="detailmodel" class="modal fade" tabindex="-1" aria-labelledby="primary-header-detail-task" aria-hidden="true">
    <form action="{{ route('admin.projects.createMeeting') }}" method="POST">
        @csrf
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header modal-colored-header bg-primary text-white">
                    <h4 class="modal-title text-white" id="primary-header-modalLabel">
                        Meeting Detail
                    </h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="meetingdetailbox">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </form>
</div>

<script>
    $(document).on("click", ".meetingnotes", function () {
        $('#meeting_id').empty();
        
        var data = $(this).data('data');
        var notes1 = data.notes;
        $('#meeting_id').val(data.id);
        tinymce.get('mymce1').setContent(notes1);
    });

    $(document).on("click", ".meetingdetail", function () {
        
        var data = $(this).data('data');
        $('#meetingdetailbox').empty();
        if(data != null){
            $('#meetingdetailbox').append('<h6 class=""><span class="fw-bold">Title:</span> '+data.title+'</h6><p><span class="fw-bold">Description: </span>'+data.description+'</p><p><span class="fw-bold">Start At: </span>'+data.start_at+'</p><p><span class="fw-bold">End At: </span>'+data.end_at+'</p><p><span class="fw-bold">URL: </span><a href="'+data.meeting_url+'"></a>'+data.meeting_url+'</p><p><span class="fw-bold">Notes: </span>'+data.notes+'</p><p><span class="fw-bold">Status: </span>'+data.status+'</p>');
        }
    });
</script>