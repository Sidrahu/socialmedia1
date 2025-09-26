<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            ❤️ People who liked your posts
        </h2>
    </x-slot>

    <div class="container mt-4" style="max-width: 800px;">
        @php $hasLikes = false; @endphp

        @foreach ($likes as $like)
            @if ($like->user_id !== auth()->id())
                @php $hasLikes = true; @endphp

                <div class="card mb-3 border-0 shadow-sm rounded-4 hover-shadow"
                     style="transition: all 0.3s;">
                    <div class="card-body d-flex justify-content-between align-items-center gap-3">

                        {{-- 👤 Left Section --}}
                        <div class="d-flex align-items-start">
                            {{-- User Avatar --}}
                            <img src="{{ $like->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . $like->user->name }}"
                                 alt="avatar"
                                 class="rounded-circle me-3 shadow-sm"
                                 style="width: 50px; height: 50px; object-fit: cover;">

                            <div>
                                <div class="fw-bold">
                                    {{ $like->user->name }}
                                    <span class="text-muted small">liked your post</span>
                                </div>
                                <small class="text-muted">{{ $like->created_at->diffForHumans() }}</small>

                                {{-- Post Preview --}}
                                <p class="mt-2 text-muted mb-1" style="font-size: 0.9rem;">
                                    {{ Str::limit(strip_tags($like->post->body), 80, '...') }}
                                </p>

                                {{-- View Post Link --}}
                                <a href="{{ route('post.show', $like->post->id) }}"
                                   class="btn btn-sm btn-outline-primary px-3 py-1 rounded-pill">
                                    View Post
                                </a>
                            </div>
                        </div>

                        {{-- 🖼 Post Thumbnail --}}
                        @if ($like->post->image)
                            <a href="{{ route('post.show', $like->post->id) }}">
                                <img src="{{ asset('storage/' . $like->post->image) }}"
                                     alt="Post Image"
                                     class="rounded-3 shadow-sm"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                            </a>
                        @endif
                    </div>
                </div>
            @endif
        @endforeach

        {{-- ❗ Empty State --}}
        @if (! $hasLikes)
            <div class="alert alert-info text-center py-4 rounded-3 shadow-sm">
                <i class="bi bi-heart text-danger fs-4 mb-2"></i>
                <p class="mb-0">No likes yet on your posts (excluding your own likes).</p>
            </div>
        @endif
    </div>

    {{-- ✅ Extra Styling --}}
    <style>
        .hover-shadow:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.08);
        }
    </style>
</x-app-layout>
