<?php

namespace App\Livewire;
use App\Notifications\FollowedYouNotification;
use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserProfile extends Component
{
    public $user;
    public $isFollowing;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->isFollowing = Auth::user()->following->contains($user->id);
    }

    public function toggleFollow()
    {
        if ($this->isFollowing) {
            Auth::user()->following()->detach($this->user->id);
        } else {
            Auth::user()->following()->attach($this->user->id);
        }
        
         if ($this->user->id !== Auth::id()) {
            $this->user->notify(new FollowedYouNotification(Auth::user()));
        }

        $this->isFollowing = !$this->isFollowing;
    }

    public function render()
{
    $user = $this->user;
    $posts = $user->posts()->latest()->get();
    $followersCount = $user->followers()->count();
    $followingCount = $user->following()->count();

    return view('livewire.user-profile', [
        'user' => $user,
        'posts' => $posts,
        'followersCount' => $followersCount,
        'followingCount' => $followingCount,
    ])->layout('layouts.app');
}

    
}