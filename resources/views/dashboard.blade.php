<x-app-layout>

    {{-- 🧭 Header --}}
    {{-- <x-slot name="header">
        <div style="margin-left: 180px;">  --}}
            {{-- Sidebar offset --}}
            {{-- <div class="d-flex justify-content-between align-items-center"> --}}
                {{-- <h2 class="font-semibold text-xl text-dark m-0">📋 News Feed</h2>
                <span class="badge bg-primary-subtle text-primary fs-6 px-3 py-2 rounded-pill shadow-sm">
                    {{ Auth::user()->name }}
                </span>
            </div>
        </div>
    </x-slot> --}}

    {{-- 🧱 Dashboard Content --}}
    <div class="py-5 bg-light min-vh-100"> {{-- Sidebar offset --}}
        <div class="container">
            <div class="row justify-content-center">

                {{-- 🧾 Center Column --}}
                <div class="col-md-10 col-lg-8">

                    {{-- 👋 Welcome Card --}}
                    <div class="card border-0 shadow-sm mb-4" style="border-radius: 16px;">
                        <div class="card-body bg-white">
                            <div class="d-flex align-items-center">
                                <img src="{{ Auth::user()->profile_photo_url ?? 'https://ui-avatars.com/api/?name=' . Auth::user()->name }}"
                                     class="rounded-circle shadow-sm me-3"
                                     style="width: 50px; height: 50px;">
                                <div>
                                    <h4 class="mb-0 fw-bold">{{ Auth::user()->name }}</h4>
                                    <small class="text-muted">👋 Welcome back! Ready to post something new?</small>
                                </div>
                            </div>
                        </div>
                    </div>

                   {{-- 📝 Post Form --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background-color: white;">
    <div class="card-body">
        @livewire('post-form')
    </div>
</div>

{{-- 📰 Post Feed --}}
<div class="card border-0 shadow-sm mb-4" style="border-radius: 16px; background-color: white;">
    <div class="card-body">
        @livewire('post-feed')
    </div>
</div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
