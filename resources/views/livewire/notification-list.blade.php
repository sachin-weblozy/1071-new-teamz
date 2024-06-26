<li class="nav-item dropdown nav-icon-hover-bg rounded-circle">
    <a class="nav-link position-relative" href="javascript:void(0)" id="drop2" aria-expanded="false">
      <iconify-icon icon="solar:bell-bing-line-duotone" class="fs-6"></iconify-icon>
      @if($notifications->isNotEmpty())
      <span class="position-absolute top-0 end-1 p-1 badge rounded-pill bg-danger">
        <span class="visually-hidden">New alerts</span>
      </span>
      @endif
    </a>
    <div class="dropdown-menu content-dd dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
      <div class="d-flex align-items-center justify-content-between py-3 px-7">
        <h5 class="mb-0 fs-5 fw-semibold">Notifications</h5>
        @if($notifications->isNotEmpty())
        <span type="button" class="badge text-bg-primary rounded-4 px-3 py-1 lh-sm" wire:click="clearNotifications">Clear All</span>
        @endif
      </div>
      <div class="message-body" data-simplebar>
        @forelse($notifications as $notification)
        <a href="@if(isset($notification['data']['url'])) {{ $notification['data']['url'] }} @else # @endif" class="py-6 px-3 d-flex align-items-center dropdown-item gap-3">
          <span class="flex-shrink-0 bg-success-subtle rounded-circle round d-flex align-items-center justify-content-center fs-5 text-success">
            {{-- <iconify-icon icon="solar:widget-3-line-duotone"></iconify-icon> --}}
            <iconify-icon icon="solar:checklist-minimalistic-line-duotone"></iconify-icon>
          </span>
          <div class="w-75">
            <div class="d-flex align-items-center justify-content-between">
              <h6 class="fs-3 mb-1 fw-semibold">{{ $notification['data']['title'] }}</h6>
              <span class="d-block fs-2">
                @php  $created = $notification['created_at']->diffInMinutes(now()); @endphp
                @if($created<120)
                {{ $created ?? '' }} mins ago...
                @else
                @php  $created = $notification['created_at']->diffInHours(now()); @endphp
                {{ $created ?? '' }} hrs ago...
                @endif  
            </span>
            </div>
            <span class="d-block text-truncate text-truncate fs-11">{{ mb_strimwidth($notification['data']['body'], 0, 35, '...') }}</span>
          </div>
        </a>
        @empty 
        <div class="text-center">
        No notification for you
        </div>
        @endforelse
        {{-- <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
          <span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
            <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
          </span>
          <div class="w-75">
            <div class="d-flex align-items-center justify-content-between">
              <h6 class="mb-1 fw-semibold">Event today</h6>
              <span class="d-block fs-2">9:15 AM</span>
            </div>
            <span class="d-block text-truncate text-truncate fs-11">Just a reminder that you have event</span>
          </div>
        </a>
        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
          <span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
            <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
          </span>
          <div class="w-75">
            <div class="d-flex align-items-center justify-content-between">
              <h6 class="mb-1 fw-semibold">Settings</h6>
              <span class="d-block fs-2">4:36 PM</span>
            </div>
            <span class="d-block text-truncate text-truncate fs-11">You can customize this template as you want</span>
          </div>
        </a>
        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
          <span class="flex-shrink-0 bg-warning-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-warning">
            <iconify-icon icon="solar:widget-4-line-duotone"></iconify-icon>
          </span>
          <div class="w-75">
            <div class="d-flex align-items-center justify-content-between">
              <h6 class="mb-1 fw-semibold">Launch Admin</h6>
              <span class="d-block fs-2">9:30 AM</span>
            </div>
            <span class="d-block text-truncate text-truncate fs-11">Just see the my new admin!</span>
          </div>
        </a>
        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
          <span class="flex-shrink-0 bg-primary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-primary">
            <iconify-icon icon="solar:calendar-line-duotone"></iconify-icon>
          </span>
          <div class="w-75">
            <div class="d-flex align-items-center justify-content-between">
              <h6 class="mb-1 fw-semibold">Event today</h6>
              <span class="d-block fs-2">9:15 AM</span>
            </div>
            <span class="d-block text-truncate text-truncate fs-11">Just a reminder that you have event</span>
          </div>
        </a>
        <a href="javascript:void(0)" class="py-6 px-7 d-flex align-items-center dropdown-item gap-3">
          <span class="flex-shrink-0 bg-secondary-subtle rounded-circle round d-flex align-items-center justify-content-center fs-6 text-secondary">
            <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
          </span>
          <div class="w-75">
            <div class="d-flex align-items-center justify-content-between">
              <h6 class="mb-1 fw-semibold">Settings</h6>
              <span class="d-block fs-2">4:36 PM</span>
            </div>
            <span class="d-block text-truncate text-truncate fs-11">You can customize this template as you want</span>
          </div>
        </a> --}}
      </div>
      {{-- <div class="py-6 px-7 mb-1">
        <button class="btn btn-primary w-100">See All Notifications</button>
      </div> --}}

    </div>
</li>

