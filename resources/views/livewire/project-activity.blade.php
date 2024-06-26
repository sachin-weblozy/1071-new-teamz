<div>
    <div class="card-box">
        <h5 class="header-title mb-3">Timeline</h5>
        <div class="track-order-list">
            <ul class="list-unstyled">
                {{-- @if($content=='short')
                @php $i==1; $limit =7; @endphp
                @endif --}}
                @forelse($events as $event)
                <li class="completed">
                    <h6 class="mt-0 mb-1 font-13">{{ $event->user->name }} {{ $event->type }} a {{ $event->model }}</h6>
                    <p class="text-muted font-12">{{ Helper::formatDate($event->created_at) ?? '' }} <small class="text-muted">{{ Helper::formatTime($event->created_at) ?? '' }}</small> </p>
                </li>
                {{-- @php $i++; @endphp --}}
                @if($content=='short')
                    @if($loop->iteration > 1)
                        @break
                    @endif
                @endif

                @empty 
                @endforelse
            </ul>
            @if($content=='short')
            <div class="text-center mt-4">
                <a href="{{ route('admin.projects.timeline',$project_id) }}" class="btn btn-sm btn-primary">View Details</a>
            </div>
            @endif
        </div>
    </div>
</div>
