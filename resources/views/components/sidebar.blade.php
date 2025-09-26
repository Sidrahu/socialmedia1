@php
    use App\Models\Like;
    use App\Models\Message;
    use Illuminate\Notifications\DatabaseNotification;
    use Illuminate\Support\Facades\Schema;

    /** @var \App\Models\User|null $user */
    $user = auth()->user();
    $likesCount = 0;
    $unreadMessageCount = 0;
    $unreadNotificationCount = 0;

    if ($user) {
        // ✅ Likes on *my* posts (optionally filter unseen)
        $likesQuery = Like::whereHas('post', fn($q) => $q->where('user_id', $user->id));
        if (Schema::hasColumn('likes', 'is_seen')) {
            $likesQuery->where('is_seen', false);
        }
        $likesCount = $likesQuery->count();

        // ✅ Messages sent *to me* (optionally filter unseen)
        $msgQuery = Message::where('receiver_id', $user->id);
        if (Schema::hasColumn('messages', 'is_seen')) {
            $msgQuery->where('is_seen', false);
        }
        $unreadMessageCount = $msgQuery->count();

        // ✅ Database Notifications unread
        $unreadNotificationCount = DatabaseNotification::where('notifiable_id', $user->id)
            ->where('notifiable_type', App\Models\User::class)
            ->whereNull('read_at')
            ->count();
    }
@endphp

@auth
<div id="app-left-sidebar" class="left-sidebar-wrapper d-none d-lg-flex flex-column">

    {{-- ===================== HEADER ===================== --}}
    <div class="ls-header text-center">
        <a href="{{ route('dashboard') }}" class="ls-brand-link text-decoration-none d-inline-flex flex-column align-items-center">
            <img src="{{ asset('storage/posts/log.jpeg') }}" width="60" height="60" class="rounded-circle shadow-sm mb-2 ls-brand-logo" alt="Logo">
            <span class="fw-bold ls-brand-text">{{ config('app.name','Social Media') }}</span>
        </a>
    </div>

    {{-- ===================== NAV ===================== --}}
    <nav class="ls-nav mt-3 flex-grow-1">
        <ul class="list-unstyled mb-0">
            {{-- Home --}}
            <li class="mb-1">
                <a href="{{ route('dashboard') }}" class="ls-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Home</span>
                </a>
            </li>

            {{-- Notifications --}}
            <li class="mb-1">
                <a href="{{ route('notifications') }}" class="ls-nav-link {{ request()->routeIs('notifications') ? 'active' : '' }}">
                    <i class="bi bi-bell"></i>
                    <span>Notifications</span>
                    @if ($unreadNotificationCount > 0)
                        <span class="ls-badge">{{ $unreadNotificationCount }}</span>
                    @endif
                </a>
            </li>

            {{-- Messages --}}
            <li class="mb-1">
                <a href="{{ route('chatify') }}" class="ls-nav-link {{ request()->is('chatify*') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i>
                    <span>Messages</span>
                    @if ($unreadMessageCount > 0)
                        <span class="ls-badge">{{ $unreadMessageCount }}</span>
                    @endif
                </a>
            </li>

            {{-- Likes --}}
          <li class="mb-1">
    <a href="{{ route('likes') }}" class="ls-nav-link {{ request()->routeIs('likes') ? 'active' : '' }}">
        <i class="bi bi-heart"></i>
        <span>Likes</span>
        @if ($likesCount > 0)
            <span class="ls-badge">{{ $likesCount }}</span>
        @endif
    </a>
</li>


            {{-- Profile --}}
            <li class="mb-1">
                <a href="{{ $user ? route('profile.show', $user->id) : '#' }}" class="ls-nav-link {{ request()->routeIs('profile.show') ? 'active' : '' }}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>

            {{-- Hashtags --}}
            <li class="mb-1">
                <a href="{{ url('/hashtag/laravel') }}" class="ls-nav-link {{ request()->is('hashtag*') ? 'active' : '' }}">
                    <i class="bi bi-hash"></i>
                    <span>Hashtags</span>
                </a>
            </li>
        </ul>
    </nav>

    {{-- ===================== USER DROPDOWN ===================== --}}
    <div class="ls-user mt-auto w-100">
        <div class="dropdown w-100" data-bs-auto-close="outside">
            <button class="ls-user-btn dropdown-toggle" id="sidebarUserMenu" data-bs-toggle="dropdown" aria-expanded="false" type="button">
                <img src="{{ $user->profile_photo_url ?? 'https://ui-avatars.com/api/?name='.$user->name }}" alt="avatar" width="36" height="36" class="rounded-circle me-2">
                <strong class="text-truncate ls-user-name">{{ $user->name }}</strong>
            </button>
            <ul class="dropdown-menu shadow-sm w-100 ls-user-menu" aria-labelledby="sidebarUserMenu">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.show', $user->id) }}">
                        <i class="bi bi-person me-2"></i> Profile
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('notifications') }}">
                        <i class="bi bi-bell me-2"></i> Notifications
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('sidebar-logout-form').submit();">
                        <i class="bi bi-box-arrow-right me-2"></i> Sign Out
                    </a>
                    <form id="sidebar-logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

@endauth


{{-- ===================== STYLES ===================== --}}
<style>
:root {
    --ls-brand-start: #4facfe;
    --ls-brand-end:   #00f2fe;
    --ls-brand-hover-bg: #f1faff;
    --ls-brand-text: #007bff; /* hover text */
    --ls-nav-text: #333;
    --ls-badge-bg: #ff4d4f;
    --ls-border-radius: 15px;
}

/* Wrapper */
.left-sidebar-wrapper {
    width:260px;
    height:100vh;
    position:sticky;
    top:0;
    z-index:1020;
    background:#fff;
    border-right:1px solid rgba(0,0,0,.05);
    box-shadow:0 4px 12px rgba(0,0,0,.05);
    border-radius:0 var(--ls-border-radius) var(--ls-border-radius) 0;
    padding:0 0 1rem 0;
    overflow-y:auto;
}
.left-sidebar-wrapper::-webkit-scrollbar{width:6px;} 
.left-sidebar-wrapper::-webkit-scrollbar-thumb{background:#ccc;border-radius:3px;}

/* Header */
.ls-header{
    background:linear-gradient(135deg,var(--ls-brand-start),var(--ls-brand-end));
    padding:1.5rem 1rem 1.25rem 1rem;
    border-radius:0 var(--ls-border-radius) 0 0;
    color:#fff;
}
.ls-brand-logo{border:3px solid #fff;}
.ls-brand-text{color:#fff;font-size:1.05rem;}

/* Nav */
.ls-nav{padding:0 1rem;}
.ls-nav-link{
    display:flex;
    align-items:center;
    gap:.75rem;
    padding:.7rem 1rem;
    border-radius:12px;
    font-weight:500;
    color:var(--ls-nav-text);
    text-decoration:none;
    transition:all .25s ease;
    position:relative;
}
.ls-nav-link i{font-size:1.15rem;color:#6c757d;transition:color .25s ease;}
.ls-nav-link:hover{background:var(--ls-brand-hover-bg);color:var(--ls-brand-text);}
.ls-nav-link:hover i{color:var(--ls-brand-text);} 
.ls-nav-link.active{
    background:linear-gradient(135deg,var(--ls-brand-start),var(--ls-brand-end));
    color:#fff;
}
.ls-nav-link.active i{color:#fff;}

/* Badge Counts */
.ls-badge{
    margin-left:auto;
    background:var(--ls-badge-bg);
    color:#fff;
    font-size:12px;
    line-height:1;
    padding:2px 8px;
    border-radius:12px;
}

/* User footer */
.ls-user{padding:0 1rem;}
.ls-user-btn{
    width:100%;
    background:#f8f9fa;
    border:none;
    padding:.6rem 1rem;
    border-radius:999px;
    display:flex;
    align-items:center;
    gap:.5rem;
    font-weight:600;
    color:var(--ls-nav-text);
    cursor:pointer;
    transition:all .25s ease;
}
.ls-user-btn:hover{background:var(--ls-brand-hover-bg);color:var(--ls-brand-text);} 
.ls-user-btn::after{display:none;} /* hide default caret */
.ls-user-name{max-width:130px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;}
.ls-user-menu{border-radius:12px;padding:.5rem 0;}
.ls-user-menu .dropdown-item{font-size:.9rem;padding:.5rem 1rem;}
.ls-user-menu .dropdown-item:hover{background:var(--ls-brand-hover-bg);color:var(--ls-brand-text);} 

/* Responsive tweak */
@media (max-width:991.98px){
    .left-sidebar-wrapper{display:none!important;}
}
</style>
</div>
