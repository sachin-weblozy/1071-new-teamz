<div>
    @if($homepage==1)
    <div class="card">
        <div class="card-body">
          <h4 class="card-title">My Tasks</h4>
          <div class="todo-widget">
            <ul class="list-task todo-list list-group mb-0" data-role="tasklist">
            @forelse($tasks as $task)
              <li class="list-group-item todo-item border-0 mb-0 py-3 pe-3 ps-0" data-role="task">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input success check-light-success" wire:click="toggleStatus({{ $task->id }})"/>
                  <label class="form-check-label todo-label d-md-flex align-items-center ps-2" >
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
                Yay! You have completed all tasks!  
            @endforelse
            </ul>
          </div>
        </div>
    </div>

    @else 

    <div class="datatables">
        <!-- start File export -->
        <div class="card">
          <div class="card-body">
            <div class="d-flex flex-wrap gap-3 mb-2 justify-content-between align-items-center">
                <h5 class="card-title  mb-0">Pending Tasks</h5>
                <div class="">
                    <button class="btn btn-primary" id="createTask" data-bs-toggle="modal" data-bs-target="#createmodel" data-toggle="modal" data-target="#createmodel"><i class="las la-plus"></i> Add New Task</button>
                </div>
              </div>
            <div class="table-responsive">
              <table id="zero_config" class="table table-striped table-bordered text-nowrap align-middle">
                <thead>
                  <!-- start row -->
                  <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Assigned By</th>
                    <th>Deadline</th>
                    <th>Frequency</th>
                    <th>Priority</th>
                    <th>Action</th>
                  </tr>
                  <!-- end row -->
                </thead>
                <tbody>
                  @forelse($tasks as $task)
                  <!-- start row -->
                  <tr>
                    <td>
                        <input type="checkbox" class="form-check-input success check-light-success" wire:click="toggleStatus({{ $task->id }})" id="task{{ $task->id }}" />
                        <label class="form-check-label todo-label d-md-flex align-items-center ps-2 " for="task{{ $task->id }}">
                    </td>
                    <td>
                        @if($task->deadline < $now)
                        <span class="text-danger fw-bold">{{ $task->title ?? '' }}</span>
                        @else 
                        <span class="fw-bold">{{ $task->title ?? '' }}</span>
                        @endif    
                    </td>
                    <td>{{ $task->assignedby->name ?? '' }}</td>
                    <td>{{ Helper::getDateTime($task->deadline) ?? '' }}</td>
                    <td>
                        <span class="mb-1 badge  bg-primary-subtle text-primary">@if($task->recurrence == '0'){{'None'}}@else {{ ucfirst($task->recurrence) }} @endif</span>
                    </td>
                    <td>
                        @if($task->priority == 1)
                        <span class="mb-1 badge text-bg-danger">High</span>
                        @elseif($task->priority == 2)
                        <span class="mb-1 badge text-bg-warning">Medium</span>
                        @elseif($task->priority == 3)
                        <span class="mb-1 badge text-bg-success">Low</span>
                        @endif
                    </td>
                    <td>
                      <div class="action-btn">
                          {{-- <a href="javascript:void(0)" class="text-primary edit ms-2">
                              <i class="ti ti-pencil fs-5"></i>
                            </a> --}}
                            {{-- <a type="button" title="Edit" class="text-primary edit ms-2 updatetask" data-toggle="modal" data-target="#updatemodel" data-id="{{$task->id}}" data-title="{{$task->title}}" data-type="{{$task->recurrence}}" data-assignedto="{{$task->assigned_to}}" data-deadline="{{$task->deadline}}" data-priority="{{$task->priority}}"><i class="ti ti-pencil fs-5"></i></a> --}}

                            <a type="button" class="text-primary edit ms-2 updatetask" data-bs-toggle="modal" data-bs-target="#updatemodel" data-toggle="modal" data-target="#updatemodel" data-id="{{$task->id}}" data-title="{{$task->title}}" data-type="{{$task->recurrence}}" data-assignedto="{{$task->assigned_to}}" data-deadline="{{$task->deadline}}" data-priority="{{$task->priority}}">
                                <i class="ti ti-pencil fs-5"></i>
                            </a>
                            @if($task->recurrence==0)
                                <a type="button" onclick="confirmActionNonRec(<?php echo $task->id; ?>)" class="text-dark delete ms-2">
                                    <i class="ti ti-trash fs-5"></i>
                                </a>
                            @else
                            <a type="button" onclick="confirmActionRec(<?php echo $task->id; ?>)" class="text-dark delete ms-2">
                                <i class="ti ti-trash fs-5"></i>
                              </a>
                            @endif
                        </div>
                    </td>
                  </tr>
                  <!-- end row -->
                  @empty 
                  
                  @endforelse
                  <tfoot>
                      <!-- start row -->
                      <tr>
                        <th></th>
                        <th>Title</th>
                        <th>Assigned By</th>
                        <th>Deadline</th>
                        <th>Frequency</th>
                        <th>Priority</th>
                        <th>Action</th>
                      </tr>
                      <!-- end row -->
                  </tfoot>
              </table>
                <form action="{{ route('admin.spaces.deletetask') }}" id="deletetaskform" method="POST" class="d-none">
                    @csrf
                    <input type="hidden" id="taskidfordel" name="taskid" />
                    <input type="hidden" id="allcheckfordel" name="allcheck" />
                </form>
            </div>
          </div>
        </div>

        <div class="card">
            <div class="card-body">
              <div class="mb-2">
                <h4 class="card-title mb-0">Completed Tasks</h4>
              </div>
              <div class="table-responsive">
                <table id="zero_config2" class="table table-striped table-bordered text-nowrap align-middle">
                  <thead>
                    <!-- start row -->
                    <tr>
                      <th></th>
                      <th>Title</th>
                      <th>Assigned By</th>
                      <th>Deadline</th>
                      <th>Completed At</th>
                      <th>Frequency</th>
                      <th>Priority</th>
                    </tr>
                    <!-- end row -->
                  </thead>
                  <tbody>
                    @forelse($completedTasks as $task)
                    <!-- start row -->
                    <tr>
                      <td>
                          <input type="checkbox" class="form-check-input success check-light-success" wire:click="toggleStatus({{ $task->id }})" id="task{{ $task->id }}" checked/>
                          <label class="form-check-label todo-label d-md-flex align-items-center ps-2 " for="task{{ $task->id }}">
                      </td>
                      <td>{{ $task->title ?? '' }}</td>
                      <td>{{ $task->assignedby->name ?? '' }}</td>
                      <td>{{ Helper::getDateTime($task->deadline) ?? '' }}</td>
                      <td>{{ Helper::getDateTime($task->completed_at) ?? '' }}</td>
                      <td>
                        <span class="mb-1 badge  bg-primary-subtle text-primary">@if($task->recurrence == '0'){{'None'}}@else {{ ucfirst($task->recurrence) }} @endif</span>
                      </td>
                      <td>
                          @if($task->priority == 1)
                          <span class="mb-1 badge text-bg-danger">High</span>
                          @elseif($task->priority == 2)
                          <span class="mb-1 badge text-bg-warning">Medium</span>
                          @elseif($task->priority == 3)
                          <span class="mb-1 badge text-bg-success">Low</span>
                          @endif
                      </td>
                    </tr>
                    <!-- end row -->
                    @empty 
                    
                    @endforelse
                    <tfoot>
                        <!-- start row -->
                        <tr>
                          <th></th>
                          <th>Title</th>
                          <th>Assigned By</th>
                          <th>Deadline</th>
                          <th>Completed At</th>
                          <th>Frequency</th>
                          <th>Priority</th>
                        </tr>
                        <!-- end row -->
                    </tfoot>
                </table>
              </div>
            </div>
        </div>

        <!-- Primary Header Modal -->
        <div id="createmodel" class="modal fade" tabindex="-1" aria-labelledby="primary-header-create-task" aria-hidden="true">
            <form action="{{ route('admin.spaces.addtask') }}" method="POST">
                @csrf
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary text-white">
                            <h4 class="modal-title text-white" id="primary-header-modalLabel">
                                Add Task
                            </h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="task">Title</label>
                                <input id="task" type="text" placeholder="Enter Task Detail" class="form-control" wire:model="title" name="title" required>
                                <input type="hidden" name="spaceid" value="0">
                                <input type="hidden" name="assignTo" value="{{ Auth::id() }}">
                                <span class="validation-text">
                                    @error('title') <span>{{ $message }}</span> @enderror
                                </span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="task">Deadline</label>
                                <input type="datetime-local" class="form-control flatpickr flatpickr-input" wire:model="deadline" name="deadline" id="deadline" required>
                                <span class="validation-text">
                                    @error('deadline') <span>{{ $message }}</span> @enderror
                                </span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="task">Frequency</label>
                                <select name="recurrence" class="form-control" wire:model="recurrence" id="exampleSelect1">
                                    <option value="0" selected>None</option>
                                    <option value="daily">Daily</option>
                                    <option value="weekly">Weekly</option>
                                    <option value="monthly">Monthly</option>
                                </select>
                                <span class="validation-text">
                                    @error('frequency') <span>{{ $message }}</span> @enderror
                                </span>
                            </div>
                            <div class="form-group mt-3">
                                <label for="">Priority</label>
                                <div class="d-flex">
                                    <div class="form-check mx-3">
                                        <input type="radio" class="form-check-input" value="1" id="test1" wire:model="priority" name="priority" checked required/>
                                        <label class="form-check-label" for="test1">High Priority</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input type="radio" class="form-check-input" value="2" id="test2" wire:model="priority" name="priority" required/>
                                        <label class="form-check-label" for="test2">Medium Priority</label>
                                    </div>
                                    <div class="form-check mx-3">
                                        <input type="radio" class="form-check-input" value="3" id="test3" wire:model="priority" name="priority" required/>
                                        <label class="form-check-label" for="test3">Less Priority</label>
                                    </div>
                                </div>
                                <span class="validation-text">
                                    @error('priority') <span>{{ $message }}</span> @enderror
                                </span>
                            </div>
                            {{-- <div id="insertcheckbox mt-3"></div> --}}
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

        <div id="updatemodel" class="modal fade" tabindex="-1" aria-labelledby="primary-header-update-task" aria-hidden="true">
            <form action="{{ route('admin.spaces.updatetask') }}" method="POST">
                @csrf
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                    <div class="modal-content">
                        <div class="modal-header modal-colored-header bg-primary text-white">
                            <h4 class="modal-title text-white" id="primary-header-modalLabel">
                                Edit Task
                            </h4>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" name="spaceid" value="0">
                                <input type="hidden" name="assignTo" value="{{ Auth::id() }}">
                                <label>Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Enter task title">
                                <input type="hidden" id="taskid" name="taskid">
                            </div>
                            <div class="form-group mt-3">
                                <label for="example-datetime-local-input">Deadline</label>
                                <input class="form-control" id="deadline" name="deadline" type="datetime-local" id="example-datetime-local-input" step="any">
                            </div>
                            <div class="form-group mt-3">
                                <label for="exampleSelect1">Priority<span class="text-danger">*</span></label>
                                <select name="priority" id="priority" class="form-control" id="exampleSelect1">
                                    <option value="1" selected>High</option>
                                    <option value="2">Medium</option>
                                    <option value="3">Low</option>
                                </select>
                            </div>
                            <div id="insertcheckbox"></div>
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
        <!-- /.modal -->
     
    <script>
        const confirmActionRec = (taskid) => {
            const response = confirm("Do you want to delete future recurring tasks too?");
        
            if (response) {
                var allcheck = '1';
                $('#taskidfordel').val(taskid);
                $('#allcheckfordel').val(allcheck);
                $('#deletetaskform').submit();

            } else {
                var allcheck = '0';
                $('#taskidfordel').val(taskid);
                $('#allcheckfordel').val(allcheck);
                $('#deletetaskform').submit();
            }
        }
        const confirmActionNonRec = (taskid) => {
            var allcheck = '0';
            $('#taskidfordel').val(taskid);
            $('#allcheckfordel').val(allcheck);
            $('#deletetaskform').submit();
        }

        $(document).on("click", ".updatetask", function () {
            var taskId = $(this).data('id');
            var taskTitle = $(this).data('title');
            var taskType = $(this).data('type');
            var taskassignedTo = $(this).data('assignedto');
            var taskDeadline = $(this).data('deadline');
            var taskPriority = $(this).data('priority');
            $(".modal-body #title").val(taskTitle);
            $(".modal-body #taskid").val(taskId);
            $(".modal-body #assignTo").val(taskassignedTo);
            $(".modal-body #deadline").val(taskDeadline);
            $(".modal-body #priority").val(taskPriority);
            $('#insertcheckbox').empty();
            
            if(taskType != 0){
                $('#insertcheckbox').append('<div class="form-group mt-3"><input class="form-check-input" type="checkbox" value="1" name="futurecheck" id="ftcheck'+taskId+'" /><label class="form-check-label" for="ftcheck'+taskId+'"> Update future recurring tasks?</label></div><br><div class="text-danger">Note: For recurring tasks, only time will be updated.</div>');
            }
        });
    </script>
    @endif
      
</div>