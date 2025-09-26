<div class="feed-container d-flex justify-content-center">
    <div class="w-100" style="max-width: 700px;">
        @foreach ($posts as $post)
            <div class="post-card shadow-sm mb-4">
                <div class="card-body p-4">

                    {{-- 🧍‍♂️ User Info + Time --}}
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center">
                            <img src="{{ $post->user->profile_photo_url }}" 
                                 alt="avatar" 
                                 class="user-avatar me-3">
                            <div>
                                <a href="{{ route('profile.show', $post->user->id) }}" class="user-name">
                                    {{ $post->user->name }}
                                </a>
                                <div>
                                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- 📝 Post Content --}}
                    @if ($post->content)
                        @php
                            $content = e($post->content);
                            $content = preg_replace('/#(\w+)/', '<a href="/hashtag/$1" class="hashtag">#$1</a>', $content);
                            $content = preg_replace('/@(\w+)/', '<a href="/profile/$1" class="mention">@${1}</a>', $content);
                        @endphp
                        <p class="post-content">{!! $content !!}</p>
                    @endif

                    {{-- 🖼️ Media --}}
                    @if ($post->media_path)
                        <div class="media-preview">
                            @if ($post->media_type === 'image')
                                <img src="{{ asset('storage/' . $post->media_path) }}" class="media-img" />
                            @elseif ($post->media_type === 'video')
                                <video controls class="media-video">
                                    <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    @endif

                    {{-- ❤️ Like / 🔁 Share / 💬 Comment --}}
                    <div class="actions-bar mt-3 mb-2">
                        @livewire('post-actions', ['post' => $post], key('actions-'.$post->id))
                    </div>

                    {{-- 💬 Comments --}}
                    <div class="comments-section">
                        @livewire('comment-section', ['post' => $post], key('comments-'.$post->id))
                    </div>

                </div>
            </div>
        @endforeach
    </div>
    <style>
        .feed-container {
    background: #f9fafb;
    padding: 20px;
}

.post-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    overflow: hidden;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.post-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
}

/* ✅ User Info */
.user-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}
.user-name {
    font-weight: 600;
    font-size: 16px;
    color: #111827;
    text-decoration: none;
}
.user-name:hover {
    color: #2563eb;
}

/* ✅ Content Styling */
.post-content {
    font-size: 15px;
    color: #374151;
    margin-bottom: 14px;
    line-height: 1.5;
}
.hashtag {
    color: #2563eb;
    font-weight: 500;
    text-decoration: none;
}
.hashtag:hover {
    text-decoration: underline;
}
.mention {
    color: #16a34a;
    font-weight: 500;
    text-decoration: none;
}
.mention:hover {
    text-decoration: underline;
}

/* ✅ Media Styling */
.media-preview {
    margin-bottom: 14px;
    border-radius: 12px;
    overflow: hidden;
}
.media-img,
.media-video {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
    display: block;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* ✅ Actions */
.actions-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f3f4f6;
    padding-top: 10px;
    margin-top: 10px;
}

        </style>
</div>
