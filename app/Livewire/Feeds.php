<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Feed;
use App\Models\FeedCommentLike;
use App\Models\FeedComment;
use App\Models\FeedLike;
use App\Models\User;
use App\Notifications\NewFeed;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class Feeds extends Component
{
    use WithFileUploads;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    protected $feedsPerPage = 5;

    public $message;
    public $image;
    public $feedId;
    public $comment;
    public $replyComment;
    public $replyToCommentId;
    public $usrid;

    protected $rules = [
        'message' => 'nullable|string|max:500',
        'image' => 'nullable|image|max:5024', // 1MB Max
        'comment' => 'nullable|string|max:500',
        'replyComment' => 'nullable|string|max:500',
    ];

    public function mount($usrid)  // Initialize userId here
    {
        $this->usrid = $usrid;
    }

    public function submit()
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('feeds', 'public') : null;

        if (empty($this->message) && empty($imagePath)) {
            return false;
        }else{
            $feed = Feed::create([
                'user_id' => Auth::id(),
                'message' => $this->message,
                'image' => $imagePath,
            ]);
    
            // Reset form fields
            $this->reset(['message', 'image']);
    
            $alUsers = User::get();
            foreach ($alUsers as $notifyToUser) {
                if($notifyToUser->id != Auth::id()){
                    $notifyToUser->notify(new NewFeed($notifyToUser->id));
                }
            }
        }
        
    }

    public function deleteFeed($feedId)
    {
        $feed = Feed::find($feedId);

        if ($feed && $feed->user_id == Auth::id()) {
            $feed->delete();
        }
    }

    public function toggleLike($feedId)
    {
        $userId = Auth::id();
        $like = FeedLike::where('feed_id', $feedId)->where('user_id', $userId)->first();

        if ($like) {
            $like->delete();
        } else {
            FeedLike::create([
                'feed_id' => $feedId,
                'user_id' => $userId,
            ]);
        }
    }

    public function submitComment($feedId)
    {
        $this->validate(['comment' => 'required|string|max:500']);

        FeedComment::create([
            'feed_id' => $feedId,
            'user_id' => Auth::id(),
            'comment' => $this->comment,
        ]);

        // Reset comment field
        $this->reset('comment');
    }

    public function submitReply($feedId, $parentId)
    {
        $this->validate(['replyComment' => 'required|string|max:500']);

        FeedComment::create([
            'feed_id' => $feedId,
            'user_id' => Auth::id(),
            'comment' => $this->replyComment,
            'parent_id' => $parentId,
        ]);

        // Reset reply comment field
        $this->reset(['replyComment', 'replyToCommentId']);
    }

    public function toggleCommentLike($commentId)
    {
        $userId = Auth::id();
        $existingLike = FeedCommentLike::where('feed_comment_id', $commentId)
            ->where('user_id', $userId)
            ->first();

        if ($existingLike) {
            $existingLike->delete();
        } else {
            FeedCommentLike::create([
                'feed_comment_id' => $commentId,
                'user_id' => $userId,
            ]);
        }
    }

    public function deleteComment($commentId)
    {
        $comment = FeedComment::find($commentId);

        if ($comment && $comment->user_id == Auth::id()) {
            $comment->delete();
        }
    }

    public function loadMoreFeeds()
    {
        $this->feedsPerPage += 3; // Increase the number of feeds to load
    }

    public function render()
    {
        // $feeds = Feed::with(['likes', 'comments.children'])
        //     ->latest()
        //     ->paginate($this->feedsPerPage);

        $query = Feed::with(['likes', 'comments.children'])->latest();

        if ($this->usrid != 0) {
            $query->where('user_id', $this->usrid);
        }

        $feeds = $query->paginate($this->feedsPerPage);

        return view('livewire.feeds', ['feeds' => $feeds]);
    }
}
