<div>
    <ul class="hstack mb-0 pt-1">
        @forelse($activeUsers as $user)
        <li class="ms-n8">
            <a href="javascript:void(0)" class="me-1">
              <img src="{{ $user->profile_photo_url ?? '' }}" class="rounded-circle border border-2 border-white" width="35" height="35" alt="{{ $user->name }}-img">
            </a>
          </li>
        @empty 
        @endforelse
    </ul>
</div>
