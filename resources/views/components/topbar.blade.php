<nav x-data="{ openUserMenu: false, openMobileMenu: false, showNotifications: false }" class="modern-navbar">
    <div class="navbar-container">
        <div class="nav-wrapper">

            {{-- ✅ Left: Logo --}}
            <div class="nav-left">
                <a href="{{ route('dashboard') }}" class="brand">
                    <x-application-logo class="logo" />
                </a>
            </div>

            {{-- ✅ Center: Dashboard --}}
            <div class="nav-center hidden md:flex">
                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            {{-- ✅ Right: Notifications + User Menu --}}
            <div class="nav-right hidden md:flex">

                {{-- 🔔 Notifications --}}
                <div class="dropdown-wrapper" x-data="{ showNotifications: false }">
                    <button @click="showNotifications = !showNotifications"
                            class="icon-btn"
                            aria-label="Notifications"
                            :aria-expanded="showNotifications.toString()">
                        <i class="bi bi-bell"></i>
                        @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                        @if ($unreadCount > 0)
                            <span class="badge">{{ $unreadCount }}</span>
                        @endif
                    </button>

                    {{-- ✅ Notifications Dropdown --}}
                    <div x-show="showNotifications"
                         x-transition
                         @click.away="showNotifications = false"
                         class="notifications-dropdown"
                         x-cloak
                         role="menu"
                         aria-label="Notifications menu">
                        
                        <div class="dropdown-header">
                            <h3>Notifications</h3>
                            <a href="{{ route('notifications') }}" class="view-all">View All</a>
                        </div>
                        
                        <div class="notifications-list">
                            @forelse (auth()->user()->unreadNotifications->take(5) as $notification)
                                <div class="notification-item" role="menuitem">
                                    <div class="indicator"></div>
                                    <div class="notification-content">
                                        <a href="{{ route('notifications') }}">
                                            {{ $notification->data['message'] }}
                                        </a>
                                        <small>{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">No new notifications</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                {{-- ✅ User Dropdown --}}
                <div class="dropdown-wrapper relative">
                    @php
                        $user = Auth::user();
                        $photoUrl = $user->profile_photo_url ?? asset('images/default-avatar.png');
                    @endphp

                    <button type="button"
                            class="profile-btn"
                            @click="openUserMenu = !openUserMenu"
                            @keydown.escape.window="openUserMenu = false"
                            :aria-expanded="openUserMenu.toString()">
                        <img src="{{ $photoUrl }}" alt="{{ $user->name }}">
                        <span class="user-name d-none d-lg-inline">{{ $user->name }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>

                    <div x-show="openUserMenu"
                         x-transition.origin.top.right
                         @click.away="openUserMenu = false"
                         class="user-dropdown"
                         x-cloak
                         role="menu"
                         aria-label="User menu">
                        <a href="{{ route('profile.show', auth()->id()) }}" role="menuitem">
                            <i class="bi bi-person"></i> My Profile
                        </a>
                        <a href="{{ route('profile.edit') }}" role="menuitem">
                            <i class="bi bi-pencil-square"></i> Edit Profile
                        </a>
                        <a href="{{ route('notifications') }}" role="menuitem">
                            <i class="bi bi-bell"></i> Notifications
                        </a>
                        <hr class="divider">
                        <form method="POST" action="{{ route('logout') }}" role="menuitem">
                            @csrf
                            <button type="submit" class="logout-btn">
                                <i class="bi bi-box-arrow-right"></i> Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ✅ Mobile Menu Button --}}
            <div class="md:hidden">
                <button @click="openMobileMenu = !openMobileMenu"
                        class="icon-btn"
                        aria-label="Toggle navigation"
                        :aria-expanded="openMobileMenu.toString()">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- ✅ Mobile Menu --}}
    <div x-show="openMobileMenu"
         x-transition
         class="mobile-menu"
         x-cloak>
        <a href="{{ route('dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
        <a href="{{ route('profile.show', auth()->id()) }}"><i class="bi bi-person"></i> My Profile</a>
        <a href="{{ route('notifications') }}"><i class="bi bi-bell"></i> Notifications</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"><i class="bi bi-box-arrow-right"></i> Log Out</button>
        </form>
    </div>
</nav>


<style>
/* ===============================
   Global Theme Tokens
   =============================== */
:root {
    --brand-grad-start: #4facfe;
    --brand-grad-end:   #00f2fe;
    --brand-hover-start:#6366f1;
    --brand-hover-end:  #4f46e5;
    --brand-accent:     #2563eb;
    --danger:           #ef4444;
    --text-dark:        #111827;
    --text-body:        #374151;
    --text-muted:       #6b7280;
    --bg-surface:       #ffffff;
    --bg-subtle:        #f9fafb;
    --radius-sm:        6px;
    --radius-md:        8px;
    --radius-lg:        12px;
    --radius-xl:        16px;
    --shadow-xs:        0 1px 2px rgba(0,0,0,.05);
    --shadow-sm:        0 4px 12px rgba(0,0,0,.06);
    --shadow-md:        0 8px 20px rgba(0,0,0,.08);
    --shadow-lg:        0 10px 25px rgba(0,0,0,.12);
    --trans-fast:       0.15s;
    --trans-med:        0.3s;
}

/* ===============================
   Navbar Shell
   =============================== */
.modern-navbar {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border-bottom: 1px solid rgba(255,255,255,.2);
    box-shadow: var(--shadow-sm);
    position: sticky;
    top: 0;
    z-index: 50;
    padding: 8px 0;
    transition: background var(--trans-med), box-shadow var(--trans-med);
}

.navbar-container {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 16px;
    width: 100%;
}

.nav-wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    height: 40px;
    width: auto;
}

/* ===============================
   Nav Links (center)
   =============================== */
.nav-link {
    padding: 10px 16px;
    border-radius: var(--radius-md);
    font-weight: 500;
    color: var(--text-body);
    display: flex;
    align-items: center;
    gap: 6px;
    line-height: 1;
    text-decoration: none;
    transition: all var(--trans-med);
}
.nav-link:hover {
    background: linear-gradient(135deg, var(--brand-hover-start), var(--brand-hover-end));
    color: #fff;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(79,70,229,.3);
}
.nav-link.active {
    background: linear-gradient(135deg, var(--brand-grad-start), var(--brand-grad-end));
    color: #fff;
}

/* ===============================
   Icon Button (notif + mobile)
   =============================== */
.icon-btn {
    position: relative;
    background: var(--bg-subtle);
    border: none;
    padding: 8px;
    border-radius: 50%;
    font-size: 20px;
    color: #4b5563;
    cursor: pointer;
    transition: all var(--trans-med);
}
.icon-btn:hover {
    background: #e0f2fe;
    color: var(--brand-accent);
    transform: scale(1.1);
}

/* Badge */
.badge {
    position: absolute;
    top: -6px;
    right: -6px;
    background: var(--danger);
    color: #fff;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 50%;
    font-weight: bold;
    line-height: 1;
    box-shadow: var(--shadow-xs);
}

/* ===============================
   Profile Trigger
   =============================== */
.profile-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    background: none;
    border: none;
    cursor: pointer;
    font-weight: 500;
    color: var(--text-body);
    padding: 4px 8px;
    border-radius: var(--radius-md);
    transition: background var(--trans-fast);
}
.profile-btn:hover {
    background: rgba(0,0,0,.04);
}
.profile-btn img {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
    transition: border-color var(--trans-med);
}
.profile-btn:hover img {
    border-color: var(--brand-hover-start);
}
.profile-btn .user-name {
    max-width: 120px;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

/* ===============================
   User Dropdown (compact)
   =============================== */
.user-dropdown {
    position: absolute;
    right: 0;
    top: calc(100% + 10px);
    background: var(--bg-surface);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    width: 200px;
    padding: 8px 0;
    display: flex;
    flex-direction: column;
    animation: fadeIn var(--trans-med) ease;
    border: 1px solid #f3f4f6;
}
.user-dropdown a,
.user-dropdown button {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    color: var(--text-body);
    font-size: 14px;
    width: 100%;
    background: transparent;
    border: none;
    text-decoration: none;
    text-align: left;
    transition: background var(--trans-fast);
    cursor: pointer;
}
.user-dropdown a:hover,
.user-dropdown button:hover {
    background: #f3f4f6;
}
.user-dropdown .logout-btn {
    color: var(--danger);
}
.user-dropdown .logout-btn:hover {
    background: rgba(239,68,68,.08);
}
.user-dropdown .divider {
    margin: 4px 0;
    border: 0;
    border-top: 1px solid #e5e7eb;
}

/* ===============================
   Notifications Dropdown
   =============================== */
.notifications-dropdown {
    position: absolute;
    right: 0;
    top: calc(100% + 12px);
    width: 340px;
    background: var(--bg-surface);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    z-index: 200;
    display: flex;
    flex-direction: column;
    border: 1px solid #f3f4f6;
    animation: fadeIn var(--trans-med) ease;
}

.notifications-dropdown .dropdown-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 14px 18px;
    background: var(--bg-subtle);
    border-bottom: 1px solid #e5e7eb;
}
.notifications-dropdown .dropdown-header h3 {
    font-size: 15px;
    font-weight: 600;
    margin: 0;
    color: var(--text-dark);
}
.notifications-dropdown .dropdown-header .view-all {
    font-size: 13px;
    color: var(--brand-accent);
    text-decoration: none;
    font-weight: 500;
}
.notifications-dropdown .dropdown-header .view-all:hover {
    text-decoration: underline;
}

.notifications-list {
    max-height: 300px;
    overflow-y: auto;
}
.notifications-list::-webkit-scrollbar {
    width: 6px;
}
.notifications-list::-webkit-scrollbar-thumb {
    background: #d1d5db;
    border-radius: 3px;
}

.notification-item {
    display: flex;
    align-items: flex-start;
    padding: 12px 16px;
    gap: 10px;
    border-bottom: 1px solid #f3f4f6;
    transition: background var(--trans-fast);
}
.notification-item:hover {
    background: #f3f4f6;
}
.notification-item .indicator {
    width: 10px;
    height: 10px;
    background: var(--brand-accent);
    border-radius: 50%;
    margin-top: 6px;
}
.notification-item .notification-content a {
    font-weight: 600;
    text-decoration: none;
    color: var(--text-dark);
    display: block;
}
.notification-item .notification-content small {
    color: var(--text-muted);
    font-size: 12px;
    margin-top: 4px;
    display: block;
}
.empty-state {
    text-align: center;
    padding: 16px;
    color: var(--text-muted);
    font-size: 14px;
}

/* ===============================
   Mobile Menu
   =============================== */
.mobile-menu {
    background: var(--bg-surface);
    padding: 16px;
    display: flex;
    flex-direction: column;
    gap: 12px;
    border-top: 1px solid #e5e7eb;
    box-shadow: var(--shadow-sm);
}
.mobile-menu a,
.mobile-menu button {
    padding: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-body);
    font-size: 16px;
    border-radius: var(--radius-md);
    background: transparent;
    border: none;
    text-align: left;
    text-decoration: none;
    transition: background var(--trans-fast);
    cursor: pointer;
}
.mobile-menu a:hover,
.mobile-menu button:hover {
    background: #f3f4f6;
}
.mobile-menu button {
    width: 100%;
}

/* ===============================
   Animations
   =============================== */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

</style>