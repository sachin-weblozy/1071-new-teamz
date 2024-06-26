<ul class="sidebar-menu" id="sidebarnav">
  <div class="text-center my-3">
    <a href="{{ route('admin.spaces.create') }}" class="btn-sm btn btn-outline-primary">Create New
    </a>
    <a href="{{ route('admin.spaces.index') }}" class="btn-sm btn btn-outline-primary">All Spaces
    </a>
  </div>
  
@foreach ($projects as $project)
  @if($project->spaces->isNotEmpty())
  <li class="nav-small-cap">
    <span class="hide-menu">{{ $project->title }}</span>
  </li>
  @endif
  @foreach ($project->spaces as $space)
  <li class="sidebar-item">
    <a href="{{ route('admin.spaces.show',$space->id) }}" class="sidebar-link {{ request()->is('spaces/'.$space->id) || request()->is('spaces/'.$space->id.'/addmembers') ? 'active' : '' }}">
        <iconify-icon icon="solar:quit-full-screen-square-line-duotone"></iconify-icon>
      <span class="hide-menu">{{ $space->name }}</span>
    </a>
  </li>
  @endforeach
@endforeach

</ul>