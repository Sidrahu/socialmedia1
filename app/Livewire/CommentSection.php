<?php

namespace App\Livewire;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentSection extends Component
{
    public $post;
    public $commentText = '';

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function addComment()
    {
        $this->validate([
            'commentText' => 'required|string|max:500',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $this->post->id,
            'comment' => $this->commentText,
        ]);

        $this->commentText = '';
    }

    
    
    
    public function render()
    {
            $comments = $this->post->comments()->with('user')->latest()->get();
    return view('livewire.comment-section', compact('comments'));
    
    }
}
