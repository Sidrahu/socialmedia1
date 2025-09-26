<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostLikedNotification;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;

class PostActions extends Component
{
    public Post $post;
    public bool $isLiked = false;
    public string $commentText = '';
    public EloquentCollection $comments;
    public bool $deleted = false; 
 


    public function mount(Post $post): void
    {
        $this->post = $post->load([
            'likes',
            'user',
            'comments' => fn($q) => $q->whereNull('parent_id')->with(['user', 'replies.user'])->latest(),
        ])->loadCount(['likes', 'comments']);

        $this->isLiked = $this->post->likes->contains('user_id', auth()->id());
        $this->comments = $this->post->comments;
    }

    public function toggleLike(): void
    {
        $uid = Auth::id();
        if (!$uid) return;

        if ($this->isLiked) {
            $this->post->likes()->where('user_id', $uid)->delete();
        } else {
            $this->post->likes()->firstOrCreate(['user_id' => $uid]);

            if ($this->post->user_id !== $uid) {
                $this->post->user->notify(new PostLikedNotification($this->post));
            }
        }

        $this->isLiked = ! $this->isLiked;
        $this->post->loadCount(['likes']);
    }

   public function deletePost()
{
    if ($this->post->user_id !== auth()->id()) {
        abort(403, 'Not authorized to delete this post.');
    }

    $this->post->delete();
    $this->deleted = true;

    $this->dispatch('post-deleted-success'); // Alpine ko message show karne ke liye
}



    public function addComment(): void
    {
        $this->validate([
            'commentText' => 'required|string|max:1000',
        ]);

        Comment::create([
            'post_id' => $this->post->id,
            'user_id' => Auth::id(),
            'body' => $this->commentText,
            'parent_id' => null,
        ]);

        $this->commentText = '';
        $this->refreshComments();
        $this->dispatch('comment-added', postId: $this->post->id);
    }

    protected function refreshComments(): void
    {
        $this->post->loadCount('comments');
        $this->comments = $this->post->comments()->whereNull('parent_id')->with(['user', 'replies.user'])->latest()->get();
    }

    public function render()
    {
        return view('livewire.post-actions');
    }
}
