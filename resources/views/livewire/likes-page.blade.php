<div>
   <div class="container mt-4">
    <h3 class="mb-4 fw-bold">❤️ People who liked your posts</h3>

    @forelse($likes as $like)
        <div class="card mb-3 border-0 shadow-sm rounded-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-start">
                    <img src="{{ $like->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . $like->user->name }}"
                        class="rounded-circle me-3 shadow-sm"
                        style="width: 48px; height: 48px; object-fit: cover;">
                    <div>
                        <strong>{{ $like->user->name }}</strong> liked your post.<br>
                        <small class="text-muted">{{ $like->created_at->diffForHumans() }}</small>
                        <p class="mt-2 text-muted mb-0" style="font-size: 0.875rem;">
                            {{ Str::limit(strip_tags($like->post->body), 80, '...') }}
                        </p>
                        <a href="{{ route('post.show', $like->post->id) }}"
                           class="btn btn-sm btn-link text-primary px-0 mt-1">View Post</a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-info">No likes yet on your posts (excluding your own likes).</div>
    @endforelse
</div>

</div>
