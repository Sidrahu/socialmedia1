<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\MentionedInPostNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostForm extends Component
{
    use WithFileUploads;

    public $content;
    public $media;

    public function save()
    {
        $this->validate([
            'media'   => 'nullable|file|mimes:png,jpg,jpeg,webp,mp4|max:30480',
            'content' => 'nullable|string|max:1000',
        ]);

        $path = null;
        $type = null;

        if ($this->media) {
            $mime = $this->media->getMimeType();
            $type = str_contains($mime, 'video') ? 'video' : 'image';
            $path = $this->media->store('posts', 'public');
        }

        $post = Post::create([
            'user_id'     => Auth::id(),
            'content'     => $this->content,
            'media_type'  => $type,
            'media_path'  => $path,
        ]);

        // ✅ 1. Handle Mentions
        preg_match_all('/@([\w\-]+)/', $this->content, $matches);
        $usernames = $matches[1];

        foreach ($usernames as $username) {
            $user = User::where('name', $username)->first();
            if ($user && $user->id !== Auth::id()) {
                $user->notify(new MentionedInPostNotification($post));
            }
        }

        // ✅ 2. Handle Hashtags
        $this->attachHashtags($post);

        // ✅ 3. Notify sidebar to refresh trending
        $this->dispatch('hashtags-updated'); // RightSidebar listener
        $this->dispatch('postAdded'); // For feed refresh

        $this->reset(['content', 'media']);

        session()->flash('success', 'Post created successfully!');
    }

    private function attachHashtags(Post $post): void
    {
        preg_match_all('/#([\pL\pN_]+)/u', $post->content, $matches);
        $tags = $matches[1] ?? [];

        $tagIds = [];
        foreach ($tags as $tagName) {
            $tagName = Str::lower($tagName);
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $post->tags()->sync($tagIds);
    }

    public function render()
    {
        return view('livewire.post-form');
    }
}
