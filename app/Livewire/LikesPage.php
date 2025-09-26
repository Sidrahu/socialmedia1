<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikesPage extends Component
{
    public $likes = [];

    public function mount()
    {
        $userId = Auth::id();

        // ✅ Mark unseen likes as seen
        Like::whereHas('post', fn($q) => $q->where('user_id', $userId))
            ->where('is_seen', false)
            ->update(['is_seen' => true]);

        // ✅ Get likes with related user + post
        $this->likes = Like::whereHas('post', fn($q) => $q->where('user_id', $userId))
            ->with(['user', 'post'])
            ->latest()
            ->get();
    }

    public function render()
    {
        return view('livewire.likes-page')
        ->layout('layouts.app');
    }
}
