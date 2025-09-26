<div class="container mt-4" style="max-width: 700px;">
    <h4 class="mb-4 fw-bold text-primary">#{{ $tagModel->name }} Posts</h4>

    @forelse ($posts as $post)
        <div class="post-card mb-3 p-3 rounded shadow-sm">
            <div class="d-flex align-items-center mb-3">
                <img src="{{ $post->user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.$post->user->name }}"
                     alt="Profile" class="rounded-circle me-3" width="50" height="50" style="object-fit:cover;">
                <div>
                    <h6 class="mb-0 fw-bold">{{ $post->user->name }}</h6>
                    <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                </div>
            </div>
            <div class="post-content">
                <p class="mb-0">{{ $post->content }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">No posts found for this hashtag.</p>
    @endforelse
</div>

<style>
/* ✅ Modern Card Design */
.post-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.post-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
}

/* ✅ Profile Image Style */
.post-card img {
    border: 2px solid #4facfe;
}

/* ✅ Text Styling */
h4 {
    font-weight: bold;
}
.post-content {
    font-size: 15px;
    color: #333;
}
</style>
