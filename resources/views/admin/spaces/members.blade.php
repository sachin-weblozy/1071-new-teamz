<div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Members <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $space->users->count() ?? '' }}</span>
    </h3>
    <a href="{{ route('admin.spaces.addmembers', $space->id) }}" class="btn btn-primary">Add New Member</a>
  </div>
  <div class="row">
    @forelse($space->users as $user)
    <div class="col-sm-4 col-lg-4">
      <div class="card hover-img">
        <div class="card-body p-4 text-center border-bottom">
            <img src="{{ $user->profile_photo_url ?? '' }}" alt="usr-img" class="rounded-circle mb-3" width="80" height="80">
            <h5 class="fw-semibold mb-0">{{ $user->name ?? '' }}</h5>
            <span class="text-dark fs-2">
                @if($space->project->teamlead == $user->id)
                {{ $user->department->name ?? 'Project Lead' }}
                @else 
                {{ $user->department->name ?? 'Project Member' }}
                @endif
            </span>
        </div>
        
        
      </div>
    </div>
    @empty 
    {{-- No member found --}}
    @endforelse
  </div>