<div class="container py-4">
    <h3 class="mb-4 fw-bold">🔥 Trending Hashtags</h3>

    @foreach ($hashtags as $hashtag)
        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
           <a href="{{ route('hashtags.page') }}" class="text-decoration-none text-primary fw-semibold">
    #{{ $tag }}
</a>

                #{{ $hashtag['tag'] }}
            </a>
            <span class="text-muted small">{{ $hashtag['count'] }} posts</span>
        </div>
    @endforeach
</div>
