<div>
  <div class="">
    @if($usrid == 0)
    <div class="card shadow-none border">
      <div class="card-body">
        <form wire:submit.prevent="submit" enctype="multipart/form-data">
          <div class="form-floating mb-3">
            <textarea class="form-control h-140" placeholder="Leave a comment here" id="message" wire:model="message"></textarea>
            <label for="floatingTextarea2">Share your thoughts</label>
            @error('message') <span class="error">{{ $message }}</span> @enderror
          </div>
          <div class="d-flex align-items-center gap-6 flex-wrap">
            <a class="d-flex align-items-center round-32 justify-content-center btn btn-primary rounded-circle" href="javascript:void(0)">
              <i class="ti ti-photo"></i>
            </a>
            <a href="javascript:void(0)" class="text-dark link-primary pe-3 py-2" onclick="document.getElementById('fileInput').click()">Photo / Video</a>
            <input type="file" id="fileInput" style="display: none;" wire:model="image">
            <button class="btn btn-primary ms-auto" type="submit">Post</button>
          </div>
          @if($image)
              <p>File selected: {{ $image->getClientOriginalName() }}</p>
            @endif
        </form>
      </div>
    </div>
    @endif
    @foreach($feeds as $feed)
    <div class="card">
      <div class="card-body border-bottom">
        <div class="d-flex align-items-center gap-6 flex-wrap">
          <img src="{{ $feed->user->profile_photo_url ?? '' }}" alt="user-img" class="rounded-circle" width="40" height="40">
          <h6 class="mb-0">{{ $feed->user->name ?? '' }}</h6>
          <span class="fs-2 hstack gap-2">
            <span class="round-10 text-bg-light rounded-circle d-inline-block"></span> 
            @php
            $created = $feed['created_at']->diffInMinutes(now());
            @endphp
            
            @if($created < 60)
                {{ $created }} mins ago...
            @elseif($created < 1440)
                @php
                    $created = $feed['created_at']->diffInHours(now());
                @endphp
                {{ $created }} hrs ago...
            @elseif($created < 43200)
                @php
                    $created = $feed['created_at']->diffInDays(now());
                @endphp
                {{ $created }} days ago...
            @else
                @php
                    $created = $feed['created_at']->diffInMonths(now());
                @endphp
                {{ $created }} months ago...
            @endif
          </span>
        </div>
        @if($feed->message)
          <p class="text-dark my-3">
            {{ $feed->message ?? ''}}
          </p>
        @endif
        @if($feed->image)
          <img src="{{ asset('storage/' . $feed->image) }}" alt="feed-img" height="360" class="rounded-4">
        @endif
        <div class="d-flex align-items-center @if($feed->likes->isNotEmpty()) mt-3 @else my-3 @endif">
          <div class="d-flex align-items-center gap-2">
            <a class="round-32 rounded-circle @if($feed->likedByUser(Auth::id())) btn btn-primary @else btn btn-outline-primary @endif p-0 hstack justify-content-center" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like" wire:click="toggleLike({{ $feed->id }})">
              <i class="ti ti-thumb-up"></i>
            </a>
            <span class="text-dark fw-semibold">{{ $feed->likes->count() ?? '' }}</span>
          </div>
          <div class="d-flex align-items-center gap-2 ms-4">
            <a class="round-32 rounded-circle btn btn-secondary p-0 hstack justify-content-center" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Comment">
              <i class="ti ti-message-2"></i>
            </a>
            <span class="text-dark fw-semibold">{{ $feed->comments->count() ?? '' }}</span>
          </div>
          @if($feed->user_id == Auth::id())
          <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" wire:click="deleteFeed({{ $feed->id }})">
            <i class="ti ti-trash"></i>
          </a>
          @endif
        </div>
        @if($feed->likes->isNotEmpty())
        <ul class="hstack mt-0 pt-1">
          @forelse($feed->likes as $like)
          <li class="ms-n8">
              <a href="javascript:void(0)" class="me-1">
                <img src="{{ $like->user->profile_photo_url ?? '' }}" class="rounded-circle border border-2 border-white" width="20" height="20" alt="{{ $like->user->name }}-img">
              </a>
            </li>
          @empty 
          @endforelse
        </ul>
        @endif
        @if($feed->comments->isNotEmpty())
        <div class="position-relative">
          @foreach($feed->comments as $comment)
          <div class="p-4 rounded-2 text-bg-light mb-3">
            <div class="d-flex align-items-center gap-6 flex-wrap">
              <img src="{{ $comment->user->profile_photo_url ?? '' }}" alt="user-img" class="rounded-circle" width="33" height="33">
              <h6 class="mb-0">{{ $comment->user->name ?? '' }}</h6>
              <span class="fs-2">
                <span class="p-1 text-bg-muted rounded-circle d-inline-block"></span> 
                  @php
                  $created = $comment['created_at']->diffInMinutes(now());
                  @endphp
                  
                  @if($created < 60)
                      {{ $created }} mins ago...
                  @elseif($created < 1440)
                      @php
                          $created = $comment['created_at']->diffInHours(now());
                      @endphp
                      {{ $created }} hrs ago...
                  @elseif($created < 43200)
                      @php
                          $created = $comment['created_at']->diffInDays(now());
                      @endphp
                      {{ $created }} days ago...
                  @else
                      @php
                          $created = $comment['created_at']->diffInMonths(now());
                      @endphp
                      {{ $created }} months ago...
                  @endif
              </span>
            </div>
            <p class="my-3">
              {{ $comment->comment ?? '' }}
            </p>
            <div class="d-flex align-items-center">
              <div class="d-flex align-items-center gap-2">
                <a class="round-32 rounded-circle @if($comment->likedByUser(Auth::id())) btn btn-primary @else btn btn-outline-primary @endif p-0 hstack justify-content-center" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Like" wire:click="toggleCommentLike({{ $comment->id }})">
                  <i class="ti ti-thumb-up"></i>
                </a>
                <span class="text-dark fw-semibold">{{ $comment->likes->count() }}</span>
              </div>
              <div class="d-flex align-items-center gap-2 ms-4">
                <a class="round-32 rounded-circle btn btn-secondary p-0 hstack justify-content-center" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Reply" wire:click="$set('replyToCommentId', {{ $comment->id }})">
                  <i class="ti ti-arrow-back-up"></i>
                </a>
                <span class="text-dark fw-semibold">{{ $comment->children->count() ?? ''}}</span>
              </div>
              @if($comment->user_id == Auth::id())
              <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" wire:click="deleteComment({{ $comment->id }})">
                <i class="ti ti-trash"></i>
              </a>
              @endif
            </div>
            @if($comment->likes->isNotEmpty())
            <ul class="hstack mt-0 pt-1">
              @forelse($comment->likes as $like)
              <li class="ms-n8">
                  <a href="javascript:void(0)" class="me-1">
                    <img src="{{ $like->user->profile_photo_url ?? '' }}" class="rounded-circle border border-2 border-white" width="20" height="20" alt="{{ $like->user->name }}-img">
                  </a>
                </li>
              @empty 
              @endforelse
            </ul>
            @endif

            @if($replyToCommentId === $comment->id)
                <form wire:submit.prevent="submitReply({{ $feed->id }}, {{ $comment->id }})">
                    <div class="d-flex align-items-center gap-6 flex-wrap p-3 flex-lg-nowrap">
                      <img src="{{ Auth::user()->profile_photo_url ?? '' }}" alt="user-img" class="rounded-circle" width="33" height="33">
                      <input type="text" class="form-control py-8" id="exampleInputtext" aria-describedby="textHelp" placeholder="Comment" wire:model="replyComment">
                      <button class="btn btn-primary" type="submit">Comment</button>
                    </div>
                    @error('replyComment') <span class="error">{{ $message }}</span> @enderror
                </form>
            @endif
          </div>

            @if($comment->children)
            @foreach($comment->children as $child)
              <div class="p-4 rounded-2 text-bg-light ms-7 my-2">
                <div class="d-flex align-items-center gap-6 flex-wrap">
                  <img src="{{ $child->user->profile_photo_url ?? '' }}" alt="user-img" class="rounded-circle" width="40" height="40">
                  <h6 class="mb-0">{{ $child->user->name ?? '' }}</h6>
                  <span class="fs-2">
                    <span class="p-1 text-bg-muted rounded-circle d-inline-block"></span>
                    @php
                    $created = $child['created_at']->diffInMinutes(now());
                    @endphp
                    
                    @if($created < 60)
                        {{ $created }} mins ago...
                    @elseif($created < 1440)
                        @php
                            $created = $child['created_at']->diffInHours(now());
                        @endphp
                        {{ $created }} hrs ago...
                    @elseif($created < 43200)
                        @php
                            $created = $child['created_at']->diffInDays(now());
                        @endphp
                        {{ $created }} days ago...
                    @else
                        @php
                            $created = $child['created_at']->diffInMonths(now());
                        @endphp
                        {{ $created }} months ago...
                    @endif
                  </span>
                </div>
                <p class="my-3">
                  {{ $child->comment ?? '' }}
                </p>
                <div class="d-flex align-items-center">
                  @if($child->user_id == Auth::id())
                  <a class="text-dark ms-auto d-flex align-items-center justify-content-center bg-transparent p-2 fs-4 rounded-circle" href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete" wire:click="deleteComment({{ $child->id }})">
                    <i class="ti ti-trash"></i>
                  </a>
                  @endif
                </div>
              </div>
            @endforeach
            @endif
          @endforeach
        </div>
        @endif
      </div>

      <form wire:submit.prevent="submitComment({{ $feed->id }})">
        <div class="d-flex align-items-center gap-6 flex-wrap p-3 flex-lg-nowrap">
          <img src="{{ Auth::user()->profile_photo_url ?? '' }}" alt="user-img" class="rounded-circle" width="33" height="33">
          <input type="text" class="form-control py-8" id="exampleInputtext" aria-describedby="textHelp" placeholder="Comment" wire:model="comment">
          <button class="btn btn-primary" type="submit">Comment</button>
        </div>
        @error('comment') <span class="error">{{ $message }}</span> @enderror
      </form>
    </div>

    @endforeach

    <div class="text-center mt-4">
      @if ($feeds->hasMorePages())
        <button wire:click="loadMoreFeeds" class="btn btn-primary">Load More</button>
      @else
        @if($feeds->isNotEmpty())
        <p>No more feeds to load</p>
        @endif
      @endif
    </div>
  </div>
  <script>
    // Function to handle file selection
    function handleFileSelect() {
        // Perform any additional actions here
    }

    // Add event listener to file input
    document.getElementById('fileInput').addEventListener('change', handleFileSelect);
      
  </script>
</div>
