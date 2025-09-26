<div>
<nav x-data="{ open: false, showNotifications: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
   <div class="max-w-7xl px-4 sm:px-6 lg:px-8" style="margin-left: 320px;">

        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <!-- 🔔 Notification Bell -->
                <div class="relative mr-4">
                    <button @click="showNotifications = !showNotifications"
                            class="relative text-gray-600 hover:text-gray-800 focus:outline-none"
                            title="Notifications">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>

                        {{-- 🔴 Unread Count Badge --}}
                        @php
                            $unreadCount = auth()->user()->unreadNotifications->count();
                        @endphp
                        @if ($unreadCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                {{ $unreadCount }}
                            </span>
                        @endif
                    </button>

                    <!-- 🔽 Dropdown Notifications -->
                    <div x-show="showNotifications"
                         @click.away="showNotifications = false"
                         class="absolute right-0 mt-2 w-72 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                         x-cloak>
                        <div class="p-3 border-b border-gray-200 font-semibold text-sm text-gray-700">
                            Notifications
                        </div>
                        <ul class="max-h-60 overflow-y-auto text-sm text-gray-700 divide-y divide-gray-100">
                            @forelse (auth()->user()->unreadNotifications->take(5) as $notification)
                                <li class="px-4 py-2 hover:bg-gray-100">
                                    <a href="{{ route('notifications') }}">
                                        {{ $notification->data['message'] }}
                                        <div class="text-xs text-gray-500">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </div>
                                    </a>
                                </li>
                            @empty
                                <li class="px-4 py-2 text-gray-500">
                                    No new notifications
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>




                
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                        <path d="M5.516 7.548a.75.75 0 011.06-.016L10 10.939l3.424-3.407a.75.75 0 111.06 1.06l-4 4a.75.75 0 01-1.06 0l-4-4a.75.75 0 01-.016-1.06z" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <!-- 👤 My Profile -->
                            <x-dropdown-link :href="route('profile.show', auth()->id())">
                                {{ __('My Profile') }}
                            </x-dropdown-link>

                            <!-- ✏️ Edit Profile -->
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Edit Profile') }}
                            </x-dropdown-link>

                            <!-- 🔔 Notifications -->
                            <x-dropdown-link :href="route('notifications')">
                                {{ __('Notifications') }}
                            </x-dropdown-link>
  @csrf
                            <!-- 🚪 Logout -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <!-- Hamburger menu for mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>
</div>
