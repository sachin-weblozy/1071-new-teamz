<div>
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
