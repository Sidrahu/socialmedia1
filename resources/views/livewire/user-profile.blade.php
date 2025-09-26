<div class="container mt-5 mb-5" style="max-width: 600px;">

    <!-- 🧍‍♂️ Profile Card -->
    <div class="card p-4 shadow-sm rounded-4 border-0 bg-white mb-4">

        <!-- 👤 Profile Image -->
        <div class="text-center mb-3">
            <img src="{{ $user->profile_photo_url }}"
                 alt="avatar"
                 class="rounded-circle shadow"
                 style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #000;">
        </div>

        <!-- 🔤 Name & Username -->
        <h4 class="fw-bold text-center mb-1">{{ $user->name }}</h4>
        <div class="text-muted text-center mb-2">{{ '@' . Str::slug($user->name) }}</div>


        <!-- 📝 Bio -->
        @if ($user->bio)
            <p class="text-muted text-center px-2" style="font-style: italic;">“{{ $user->bio }}”</p>
        @endif

        <!-- 👥 Stats Row -->
        <div class="row text-center mt-3">
            <div class="col border-end">
                <h6 class="mb-0 fw-bold">{{ $followersCount }}</h6>
                <small class="text-muted">Followers</small>
            </div>
            <div class="col border-end">
                <h6 class="mb-0 fw-bold">{{ $followingCount }}</h6>
                <small class="text-muted">Following</small>
            </div>
            <div class="col">
                <h6 class="mb-0 fw-bold">{{ $posts->count() }}</h6>
                <small class="text-muted">Posts</small>
            </div>
        </div>

        <!-- 🔁 Edit / Follow Button -->
        <div class="text-center mt-4">
            @if (auth()->id() !== $user->id)
                <button wire:click="toggleFollow"
                        class="btn btn-sm px-4 rounded-pill shadow-sm"
                        style="background-color: transparent; border: 2px solid black; color: black;">
                    {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                </button>
            @else

   <a 
    href="{{ route('profile.edit') }}" 
    wire:navigate.prevent
    class="btn btn-sm px-4 rounded-pill shadow-sm"
    style="background-color: transparent; border: 2px solid black; color: black;">
    <i class="bi bi-pencil-square me-2"></i> Edit Profile
</a>



            @endif
        </div>
    </div>

    <!-- 🖼️ Recent Posts Preview -->
    <div>
        <h5 class="mb-3 fw-bold">📌 Recent Posts</h5>

        @if($posts->count())
            <div class="d-flex flex-nowrap overflow-auto gap-3 pb-2" style="scroll-snap-type: x mandatory;">
                @foreach($posts as $post)
                    <div class="card shadow-sm border-0 rounded-4" style="min-width: 280px; max-width: 280px; scroll-snap-align: start;">
                        <div class="card-body p-3">

                            {{-- 📝 Post Text --}}
                            <p class="mb-2 text-dark">{{ Str::limit(strip_tags($post->content), 100, '...') }}</p>

                            {{-- 📸 Post Media --}}
                            @if ($post->media_path)
                                @if ($post->media_type === 'image')
                                    <img src="{{ asset('storage/' . $post->media_path) }}"
                                         class="img-fluid rounded mb-2"
                                         style="max-height: 200px; object-fit: cover; width: 100%;" />
                                @elseif ($post->media_type === 'video')
                                    <video controls class="w-100 rounded mb-2" style="max-height: 200px;">
                                        <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                @endif
                            @endif

                            {{-- 🕒 Timestamp --}}
                            <div class="text-end">
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-info">No posts yet.</div>
        @endif
    </div>
</div>
