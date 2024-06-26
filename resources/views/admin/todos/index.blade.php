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
                          <li class="breadcrumb-item active" aria-current="page"><span>Todos</span></li>
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
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="mail-box-container">
                <div class="mail-overlay"></div>
                <div class="tab-title">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 d-flex align-center justify-content-between">
                            <h5 class="app-title">Todos</h5>
                            <i class="las la-tasks font-25 text-primary"></i>
                        </div>
                        <div class="todoList-sidebar-scroll">
                            <div class="col-md-12 col-sm-12 col-12 mt-4 pl-0 pr-0">
                                <ul class="nav nav-pills d-block" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link list-actions active" id="all-list" data-toggle="pill" href="#pills-inbox" role="tab" aria-selected="true"> <i class="las la-list font-20 mr-2"></i> Todos <span class="todo-badge badge">{{$todos->count()}}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link list-actions" id="todo-task-done" data-toggle="pill" href="#pills-sentmail" role="tab" aria-selected="false"><i class="lar la-check-circle font-20 mr-2"></i> Completed <span class="todo-badge badge">{{$completedTodos->count()}}</span></a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link list-actions" id="todo-task-important" data-toggle="pill" href="#pills-important" role="tab" aria-selected="false"><i class="lar la-star font-20 mr-2"></i> Important <span class="todo-badge badge">0</span></a>
                                    </li> --}}
                                    <li class="nav-item">
                                        <a class="nav-link list-actions" id="todo-task-trash" data-toggle="pill" href="#pills-trash" role="tab" aria-selected="false"><i class="lar la-trash-alt font-20 mr-2"></i> Trash<span class="todo-badge badge">{{$deletedTodos->count()}}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <a class="btn btn-primary" id="addTask" href="#"> Add a todo</a>
                    </div>
                </div>
                <div id="todo-inbox" class="accordion todo-inbox">
                    <div class="todo-box">
                        <div id="ct" class="todo-box-scroll">
                            @foreach($todos as $todo)
                            <div class="todo-item all-list">
                                <div class="todo-item-inner">
                                    <div class="n-chk text-center todoidbox">
                                        <label class="new-control new-checkbox checkbox-primary">
                                          <input type="checkbox" class="new-control-input inbox-chkbox checktodo" @if($todo->completed_at != null) checked @endif>
                                          <input type="hidden" class="todoid" value="{{ $todo->id }}">
                                          <span class="new-control-indicator"></span>
                                        </label>
                                    </div>
                                    <div class="task-date">
                                        <span>{{ date('d', strtotime($todo->deadline)) }}</span>
                                        <span>{{ date('M', strtotime($todo->deadline)) }}</span>
                                        <span>{{ date('Y', strtotime($todo->deadline)) }}</span>
                                    </div>
                                    <div class="todo-content">
                                        <h5 class="todo-heading">{{ $todo->title ?? '' }}</h5>
                                    </div>
                                    <div class="priority-dropdown custom-dropdown-icon">
                                        <div class="dropdown p-dropdown">
                                            @if($todo->priority==1)
                                            <span class="badge bg-danger">High</span>
                                            @elseif($todo->priority==2)
                                            <span class="badge bg-warning">Medium</span>
                                            @elseif($todo->priority==3)
                                            <span class="badge bg-info">Low</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="action-dropdown custom-dropdown-icon">
                                        <div class="dropdown">
                                            <a class="dropdown-toggle font-20" href="#" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                <i class="las la-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
                                                <a class="edit edittodo dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#editTaskModal" data-id="{{$todo->id}}" data-title="{{$todo->title}}" data-deadline="{{$todo->deadline}}" data-priority="{{$todo->priority}}">Edit Todo</a>
                                                <form action="{{ route('admin.todos.destroy', $todo->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="dropdown-item deletetodo delete">Delete Task</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div class="todo-item todo-task-done">

                            </div>
                        </div>
                    </div>
                </div>                                    
            </div>
            <!-- Add Task Modal -->
            <div class="modal fade" id="addTaskModal" tabindex="-1" role="dialog" aria-labelledby="addTaskModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.todos.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <i class="las la-times"  data-dismiss="modal"></i>
                            <div class="compose-box">
                                <div class="compose-content" id="addTaskModalTitle">
                                    <h5 class="">Add Todo</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex mail-to mb-4">
                                                <div class="w-100">
                                                    <label for="task">Title</label>
                                                    <input id="task" type="text" placeholder="Todo Title" class="form-control" name="title">
                                                    <span class="validation-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <div class="w-100">
                                            <label for="task">Deadline</label>
                                            <input type="datetime-local" class="form-control flatpickr flatpickr-input" name="deadline" id="deadline">
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <div class="w-100 priority-radio">
                                            <p>
                                            <input type="radio" value="1" id="test1" name="priority" checked>
                                            <label for="test1" class="text-danger">High Priority</label>
                                            </p>
                                            <p>
                                                <input type="radio" value="2" id="test2" name="priority">
                                                <label for="test2" class="text-warning">Medium Priority</label>
                                            </p>
                                            <p>
                                                <input type="radio" value="3" id="test3" name="priority">
                                                <label for="test3" class="text-info">Less Priority</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-sm btn-danger" data-dismiss="modal">Discard</button>
                            <button class="btn btn-sm btn-primary">Add Task</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Task Modal -->
            <div class="modal fade" id="editTaskModal" tabindex="-1" role="dialog" aria-labelledby="editTaskModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <form action="{{ route('admin.todos.updatetodo') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <i class="las la-times"  data-dismiss="modal"></i>
                            <div class="compose-box">
                                <div class="compose-content" id="addTaskModalTitle">
                                    <h5 class="">Edit Todo</h5>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="d-flex mail-to mb-4">
                                                <div class="w-100">
                                                    <label for="task">Title</label>
                                                    <input id="id" value="" type="hidden" name="id">
                                                    <input id="updatetodotitle" type="text" placeholder="Todo Title" class="form-control" name="title">
                                                    <span class="validation-text"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <div class="w-100">
                                            <label for="task">Deadline</label>
                                            <input type="datetime-local" class="form-control flatpickr flatpickr-input" name="deadline" id="updatetododeadline">
                                        </div>
                                    </div>
                                    <div class="d-flex mb-4">
                                        <div class="w-100 priority-radio todopriority">
                                            <p>
                                                <input type="radio" value="1" id="updatetodopriority1" name="priority">
                                                <label for="updatetodopriority1" class="text-danger">High Priority</label>
                                            </p>
                                            <p>
                                                <input type="radio" value="2" id="updatetodopriority2" name="priority">
                                                <label for="updatetodopriority2" class="text-warning">Medium Priority</label>
                                            </p>
                                            <p>
                                                <input type="radio" value="3" id="updatetodopriority3" name="priority">
                                                <label for="updatetodopriority3" class="text-info">Less Priority</label>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button class="btn btn-sm btn-danger" data-dismiss="modal">Discard</button>
                            <button class="btn btn-sm btn-primary">Update Todo</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".edittodo", function () {
        var todoId = $(this).data('id');
        var todoTitle = $(this).data('title');
        var todoDeadline = $(this).data('deadline');
        var todoPriority = $(this).data('priority');
        $(".modal-body #id").val(todoId);
        $(".modal-body #updatetodotitle").val(todoTitle);
        $(".modal-body #updatetododeadline").val(todoDeadline);

        if(todoPriority == 1){
            $(".todopriority #updatetodopriority1").prop("checked", true);
        }else if(todoPriority == 2){
            $(".todopriority #updatetodopriority2").prop("checked", true);
        }else if(todoPriority == 3){
            $(".todopriority #updatetodopriority3").prop("checked", true);
        }
    });

    $(document).ready(function(){
        $(".checktodo").click(function(){
            var todo_id = $(this).closest('.todoidbox').find('.todoid').val();
            var stats = $(this).closest('.todoidbox').find('.checktodo').is(':checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                method: "POST",
                url: "/update-todostatus",
                data: {
                    'todo_id': todo_id,
                    'status': stats,
                },
                success: function(response){
                    // window.location.reload();
                    // swal(
                    //     'Success',
                    //     response.status,
                    //     'success'
                    // );
                }
            });
        });
    });
</script>
@endsection