<div class="right-sidebar px-3 pt-3" style="width: 340px; max-width: 100%;">

    {{-- ✅ Active Now --}}
    <div class="card custom-card mb-4">
        <div class="card-header gradient-header text-white d-flex align-items-center">
            <i class="bi bi-circle-fill text-light me-2 fs-6"></i>
            <h6 class="fw-bold mb-0">Active Now</h6>
        </div>
        <div class="card-body d-flex overflow-auto py-3" style="gap:18px;">
            @forelse ($onlineUsers as $user)
                <div class="text-center" style="width:70px;">
                    <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none">
                        <div class="position-relative user-avatar">
                            <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.$user->name }}"
                                 class="rounded-circle shadow-lg"
                                 style="width:60px;height:60px;object-fit:cover;border: 3px solid #34c759;">
                            <span class="status-dot"></span>
                        </div>
                        <small class="d-block mt-2 text-muted fw-semibold text-truncate" style="font-size:12px;">
                            {{ \Illuminate\Support\Str::limit($user->name,10) }}
                        </small>
                    </a>
                </div>
            @empty
                <p class="text-muted small mb-0">No one is online now.</p>
            @endforelse
        </div>
    </div>

    {{-- ✅ Chat with Friends --}}
    <div class="card custom-card mb-4">
        <div class="card-header gradient-header text-white d-flex align-items-center">
            <i class="bi bi-chat-dots me-2 fs-5"></i>
            <h6 class="fw-bold mb-0">Chat with Friends</h6>
        </div>
        <div class="card-body pt-3 scroll-area">
            @forelse ($friends as $user)
                <div class="d-flex align-items-center justify-content-between mb-3 hover-card">
                    <div class="d-flex align-items-center">
                        <img src="{{ $user->profile_photo_url }}" class="rounded-circle me-3 shadow" width="40" height="40" style="object-fit:cover;">
                        <a href="{{ route('profile.show',$user->id) }}" class="fw-semibold text-dark text-decoration-none">
                            {{ $user->name }}
                        </a>
                    </div>
                    <a href="{{ route('chatify',['user'=>$user->id]) }}" class="btn btn-sm btn-brand rounded-pill px-3">
                        Message
                    </a>
                </div>
            @empty
                <p class="text-muted small mb-0">No friends available.</p>
            @endforelse
        </div>
    </div>

    {{-- ✅ Trending Hashtags --}}
    <div class="card custom-card mb-4">
        <div class="card-header gradient-header text-white d-flex align-items-center">
            <i class="bi bi-fire me-2 fs-5"></i>
            <h6 class="fw-bold mb-0">Trending Hashtags</h6>
        </div>
        <div class="card-body pt-3 scroll-area">
            @forelse ($trendingTags as $tag => $count)
                <a href="{{ route('hashtag.show', $tag) }}" class="d-flex justify-content-between align-items-center mb-3 hover-card text-decoration-none text-dark">
                    <div>
                        <span class="fw-semibold">#{{ $tag }}</span>
                        <small class="text-muted d-block">{{ $count }} posts</small>
                    </div>
                    <div class="progress" style="width: 100px; height: 6px;">
                        <div class="progress-bar bg-success" style="width: {{ intval(($count / max($trendingTags)) * 100) }}%;"></div>
                    </div>
                </a>
            @empty
                <p class="text-muted small mb-0 text-center">No trending tags.</p>
            @endforelse
        </div>
    </div>

    {{-- ✅ Tech News --}}
  <div class="card custom-card mb-4">
    <div class="card-header gradient-header text-white d-flex align-items-center">
        <i class="bi bi-newspaper me-2 fs-5"></i>
        <h6 class="fw-bold mb-0">Tech News</h6>
    </div>
    <div class="card-body pt-3">
        <ul class="list-unstyled small mb-0">
            <li class="mb-3">
                <a href="https://laravel.com/docs/11.x" target="_blank" rel="noopener noreferrer" 
                   class="text-decoration-none text-dark hover-link d-flex align-items-center">
                    📢 Laravel 11 Released!
                    <i class="bi bi-box-arrow-up-right ms-2 text-muted"></i>
                </a>
            </li>
            <li class="mb-3">
                <a href="https://filamentphp.com" target="_blank" rel="noopener noreferrer" 
                   class="text-decoration-none text-dark hover-link d-flex align-items-center">
                    🚀 AI + Filament Dashboards
                    <i class="bi bi-box-arrow-up-right ms-2 text-muted"></i>
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/jobs" target="_blank" rel="noopener noreferrer" 
                   class="text-decoration-none text-dark hover-link d-flex align-items-center">
                    📈 Dev Jobs Rising in Pakistan
                    <i class="bi bi-box-arrow-up-right ms-2 text-muted"></i>
                </a>
            </li>
        </ul>
    </div>


<style>
.hover-link {
    transition: color 0.3s ease;
}
.hover-link:hover {
    color: #007bff;
    text-decoration: underline;
}
</style>
</div>

    {{-- ✅ Who to Follow --}}
    <div class="card custom-card mb-4">
        <div class="card-header gradient-header text-white d-flex align-items-center">
            <i class="bi bi-person-plus me-2 fs-5"></i>
            <h6 class="fw-bold mb-0">Who to Follow</h6>
        </div>
        <div class="card-body pt-3 scroll-area">
            @forelse ($suggested as $user)
                <div class="d-flex align-items-center justify-content-between mb-3 hover-card">
                    <div class="d-flex align-items-center">
                        <img src="{{ $user->profile_photo_url }}" class="rounded-circle me-3 shadow" width="42" height="42" style="object-fit:cover;">
                        <a href="{{ route('profile.show', $user->id) }}" class="fw-semibold text-dark text-decoration-none">
                            {{ $user->name }}
                        </a>
                    </div>
                    @if(in_array($user->id, $followingIds))
                        <button wire:click="unfollow({{ $user->id }})" class="btn btn-sm btn-brand-outline rounded-pill px-3">
                            Following
                        </button>
                    @else
                        <button wire:click="follow({{ $user->id }})" class="btn btn-sm btn-brand rounded-pill px-3">
                            Follow
                        </button>
                    @endif
                </div>
            @empty
                <p class="text-muted small mb-0 text-center">No suggestions available.</p>
            @endforelse
        </div>
    </div>



<style>
/* ===============================================
   ✅ Brand Color System (change once, reflects everywhere)
   =============================================== */
:root {
    --brand-color: #4facfe; /* Primary brand color */
    --brand-color-hover: #3a8de2;
    --brand-color-text-contrast: #ffffff;
}

/* ✅ Custom Card Base */
.custom-card {
    border-radius: 15px;
    background: #fff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* ✅ Gradient header (brand tint) */
.gradient-header {
    background: linear-gradient(135deg, var(--brand-color) 0%, #00f2fe 100%);
    border-radius: 15px 15px 0 0;
}

/* ===============================================
   ✅ Unified Buttons
   =============================================== */
.btn-brand {
    background: var(--brand-color) !important;
    border: 1px solid var(--brand-color) !important;
    color: var(--brand-color-text-contrast) !important;
}
.btn-brand:hover,
.btn-brand:focus {
    background: var(--brand-color-hover) !important;
    border-color: var(--brand-color-hover) !important;
    color: var(--brand-color-text-contrast) !important;
}

/* Outline variant but same color family */
.btn-brand-outline {
    background: transparent !important;
    border: 2px solid var(--brand-color) !important;
    color: var(--brand-color) !important;
}
.btn-brand-outline:hover,
.btn-brand-outline:focus {
    background: var(--brand-color) !important;
    color: var(--brand-color-text-contrast) !important;
}

/* ===============================================
   ✅ Hover Cards & Scroll Areas
   =============================================== */
.hover-card {
    background: #fff;
    border-radius: 10px;
    padding: 8px;
    transition: all 0.3s ease;
}
.hover-card:hover {
    background: #f8f9fa;
    transform: translateY(-2px);
}
.scroll-area {
    max-height: 250px;
    overflow-y: auto;
}
.scroll-area::-webkit-scrollbar {
    width: 6px;
}
.scroll-area::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 3px;
}

/* ✅ Online Status Dot */
.status-dot {
    position: absolute;
    bottom: 4px;
    right: 4px;
    width: 12px;
    height: 12px;
    background: #34c759;
    border: 2px solid #fff;
    border-radius: 50%;
}

/* ✅ Link Hover */
.hover-link:hover {
    color: var(--brand-color);
    text-decoration: underline;
}
</style>
</div>