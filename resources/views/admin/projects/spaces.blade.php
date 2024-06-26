<div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
    <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Spaces <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2">{{ $spaces->count() ?? '' }}</span>
    </h3>
    <a href="{{ route('admin.spaces.create') }}" class="btn btn-primary">Create New Space</a>
  </div>
  <div class="row">
    @forelse($spaces as $space)
    <div class="col-sm-6 col-lg-6">
      <div class="card hover-img">
        <div class="card-body p-4 text-center border-bottom">
          <a href="{{ route('admin.spaces.show',$space->id) }}"><h5 class="fw-semibold mb-0">{{ $space->name ?? '' }}</h5></a>
          <span class="text-dark fs-2">Members: {{ $space->users->count() }}</span>
        </div>
        
        <ul class="hstack mb-0 pt-1 d-flex align-items-center justify-content-center">
            @forelse($space->users as $spcmember)
            <li class="ms-n8">
              <a href="javascript:void(0)" class="me-1">
                <img src="{{ asset($spcmember->profile_photo_url) ?? '' }}" class="rounded-circle border border-2 border-white my-2 mx-auto" width="35" height="35" alt="matdash-img">
              </a>
            </li>
            @empty 
            @endforelse
            {{-- <li class="ms-n8">
              <span class="bg-primary-subtle text-primary round-40 rounded-circle d-flex align-items-center justify-content-center">+12</span>
            </li> --}}
          </ul>
      </div>
    </div>
    @empty 
    {{-- No space found --}}
    @endforelse
  </div>