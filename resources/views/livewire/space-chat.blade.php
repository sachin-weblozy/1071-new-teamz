<div>
    <style>
        .chat-box {
            width: 100% !important;
        }
        .scrollpill {
          scrollbar-width: none;
        }
    </style>
    <div class="card overflow-hidden chat-application">
        <div class="d-flex">
          <div class="w-100 w-xs-100">
            <div class="chat-box-inner-part h-100">
              <div class="chatting-box d-block">
                <div class="d-flex parent-chat-box">
                  <div class="chat-box w-xs-100">
                    <div class="chat-box-inner p-9" style="max-height: 340px;" data-simplebar>
                      <div id="scrollable" class="chat-list chat active-chat overflow-auto scrollpill" style="max-height: 300px;" data-user-id="1" >
                        @forelse($chats as $chat)
                            @if($chat->user_id != Auth::id())
                            {{-- @if($chat->type == 'task')
                            @else 
                            @endif --}}
                            <div class="hstack gap-3 align-items-start mb-7 justify-content-start">
                                <img src="{{ $chat->user->profile_photo_url ?? '' }}" alt="user8" width="40" height="40" class="rounded-circle" />
                                <div>
                                    <h6 class="fs-2 text-muted">
                                    {{ $chat->user->name ?? '' }}, {{ Helper::getDateTime($chat->created_at) ?? '' }}
                                    </h6>
                                    <div class="p-2 text-bg-light rounded-1 d-inline-block text-dark fs-3">
                                        {{ $chat->message }}
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if($chat->user_id == Auth::id())
                            <div class="hstack gap-3 align-items-start mb-7 justify-content-end">
                                <div class="text-end">
                                    <h6 class="fs-2 text-muted">{{ Helper::getDateTime($chat->created_at) ?? '' }}</h6>
                                    <div class="p-2 bg-info-subtle text-dark rounded-1 d-inline-block fs-3">
                                        {{ $chat->message }}
                                    </div>
                                </div>
                            </div>
                            @endif
                        @empty
                        <p class="text-center">
                            <span class="calling-info">Start Chat</span>
                        </p>
                        @endforelse
                      </div>
                      <!-- 2 -->
                    </div>
                    <form wire:submit.prevent="sendMessage">
                    <div class="px-9 py-6 border-top chat-send-message-footer">
                      <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2 w-85">
                          <a class="position-relative nav-icon-hover z-index-5" href="javascript:void(0)">
                            <i class="ti ti-mood-smile text-dark bg-hover-primary fs-7"></i>
                          </a>
                          <input type="text" wire:model="newMessage" class="form-control message-type-box text-muted border-0 rounded-0 p-0 ms-2" placeholder="Type a Message" fdprocessedid="0p3op" />
                        </div>
                        <ul class="list-unstyledn mb-0 d-flex align-items-center">
                          <li>
                            <a wire:click="sendMessage" class="text-dark px-2 fs-7 bg-hover-primary nav-icon-hover position-relative z-index-5" >
                              <i class="ti ti-send"></i>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>

  <script>
    
    // Function to scroll to the bottom of the chat container
    function scrollToBottom() {
      var chatContainer = document.getElementById('scrollable');
      chatContainer.scrollTop = chatContainer.scrollHeight;
    }

    // Scroll to the bottom initially and whenever new messages are added
    document.addEventListener('DOMContentLoaded', function() {
      scrollToBottom();
    });

    document.addEventListener('livewire:load', function () {
      Livewire.on('scrollToBottom', function () {
        scrollToBottom();
      });
    });

    window.addEventListener('sendMessage', e => {
      updateChat();
    });

    function updateChat() {
      scrollToBottom();
    }

    window.onload = function() {
      scrollToBottom();
    };
  </script>
</div>