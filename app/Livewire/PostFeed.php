<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
class PostFeed extends Component
{  
    public $posts;

    protected $listeners = ['postAdded' => 'loadPosts'];

    public function mount()
    {
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = Post::with('user')->latest()->get();
    }
   
    public function render()
    {
        return view('livewire.post-feed');
    }
}
