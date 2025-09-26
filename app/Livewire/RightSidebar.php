<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class RightSidebar extends Component
{
    public $onlineUsers = [];
    public $friends = [];
    public $suggested = [];
    public $trendingTags = [];
    public int $trendingLimit = 10;
    public $followingIds = [];

    protected $listeners = ['hashtags-updated' => 'loadTrendingTags'];

    public function mount(): void
    {
        $this->loadSidebarData();
    }

    /** ✅ Update only online users for polling */
   public function updateOnlineUsers()
{
    $authId = Auth::id();

    // ✅ Show users active within the last 1 minute (even if logged out)
    $this->onlineUsers = \App\Models\User::where('id', '!=', $authId)
        ->where('last_seen', '>=', now()->subMinute()) // last 1 min
        ->orderByDesc('last_seen')
        ->take(8)
        ->get();
}



    /** ✅ Load initial data for sidebar */
    private function loadSidebarData(): void
    {
        $authId = Auth::id();

        $this->updateOnlineUsers(); // load online users initially

        // Friends (for demo, all except me)
        $this->friends = User::where('id', '!=', $authId)
            ->orderBy('name')
            ->take(10)
            ->get();

        // Suggestions
        $this->loadSuggestions();

        // Trending hashtags
        $this->loadTrendingTags();
    }

    /** ✅ Trending hashtags */
    public function loadTrendingTags(): void
    {
        $this->trendingTags = Tag::withCount('posts')
            ->orderByDesc('posts_count')
            ->limit($this->trendingLimit)
            ->pluck('posts_count', 'name')
            ->toArray();
    }

    /** ✅ Suggestions */
    public function loadSuggestions(): void
    {
        $user = Auth::user();

        if (!$user) {
            $this->followingIds = [];
            $this->suggested = collect();
            return;
        }

        $this->followingIds = $user->following()->pluck('users.id')->toArray();

        $this->suggested = User::where('id', '!=', $user->id)
            ->whereNotIn('id', $this->followingIds)
            ->inRandomOrder()
            ->limit(5)
            ->get();
    }

    /** ✅ Follow */
    public function follow($userId): void
    {
        $user = Auth::user();
        if (!$user || $userId == $user->id) return;

        $user->following()->syncWithoutDetaching([$userId]);
        $this->loadSuggestions();
    }

    /** ✅ Unfollow */
    public function unfollow($userId): void
    {
        $user = Auth::user();
        if (!$user) return;

        $user->following()->detach($userId);
        $this->loadSuggestions();
    }

    public function render()
    {
        return view('livewire.right-sidebar');
    }
}
