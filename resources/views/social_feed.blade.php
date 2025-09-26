{{-- @extends('layouts.app')

@section('content')

 
@include('layouts.navbar') 

<div class="container-fluid">
    <div class="row">

       
        <div class="col-md-3 d-none d-md-block border-end min-vh-100 py-4 ps-4" style="position: sticky; top: 0;">
            <h4 class="fw-bold mb-4">Logo</h4>
            <ul class="nav flex-column fs-6">
                <li class="nav-item mb-3"><a class="nav-link text-dark" href="#"><i class="bi bi-house me-2"></i>Home</a></li>
                <li class="nav-item mb-3"><a class="nav-link text-dark" href="#"><i class="bi bi-hash me-2"></i>Explore</a></li>
                <li class="nav-item mb-3"><a class="nav-link text-dark" href="#"><i class="bi bi-bell me-2"></i>Notifications</a></li>
                <li class="nav-item mb-3"><a class="nav-link text-dark" href="#"><i class="bi bi-envelope me-2"></i>Messages</a></li>
                <li class="nav-item mb-3"><a class="nav-link text-dark" href="#"><i class="bi bi-bookmark me-2"></i>Bookmarks</a></li>
                <li class="nav-item mb-3"><a class="nav-link text-dark" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                <li class="mt-4">
                    <button class="btn btn-primary w-100 rounded-pill py-2">Tweet</button>
                </li>
            </ul>
        </div>

       
        <div class="col-md-6 px-3 py-4">

           
            <div class="card mb-4 shadow-sm">
                <div class="card-body d-flex">
                    <img src="{{ Auth::user()->profile_photo_url }}" class="rounded-circle me-3" width="48" height="48" />
                    <form method="POST" action="#" class="w-100">
                        @csrf
                        <textarea class="form-control border-0 mb-2" placeholder="What's happening?" rows="3"></textarea>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-2">
                                <i class="bi bi-card-image text-primary fs-5"></i>
                                <i class="bi bi-emoji-smile text-warning fs-5"></i>
                            </div>
                            <button class="btn btn-primary btn-sm rounded-pill px-4">Tweet</button>
                        </div>
                    </form>
                </div>
            </div>

          
            @foreach($posts as $post)
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ $post->user->profile_photo_url }}" class="rounded-circle me-2" width="40" height="40">
                            <div>
                                <strong>{{ $post->user->name }}</strong>
                                <small class="text-muted d-block">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <p>{!! nl2br(e($post->content)) !!}</p>

                        @if($post->media_path)
                            @if($post->media_type === 'image')
                                <img src="{{ asset('storage/' . $post->media_path) }}" class="img-fluid rounded mb-2" />
                            @elseif($post->media_type === 'video')
                                <video controls class="w-100 rounded mb-2">
                                    <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                                </video>
                            @endif
                        @endif

                        <div class="d-flex justify-content-around text-muted fs-6 mt-3">
                            <div><i class="bi bi-chat"></i> 3</div>
                            <div><i class="bi bi-arrow-repeat"></i> 5</div>
                            <div><i class="bi bi-heart"></i> 12</div>
                            <div><i class="bi bi-upload"></i></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

      
        <div class="col-md-3 d-none d-md-block border-start py-4 pe-4">
            <div class="bg-light rounded p-3 mb-4">
                <h6 class="fw-bold mb-3">Trends for you</h6>
                <p class="mb-2"><strong>#BreakingNews</strong><br><small class="text-muted">10.9k Tweets</small></p>
                <p class="mb-2"><strong>#WorldNews</strong><br><small class="text-muted">125k Tweets</small></p>
                <p class="mb-2"><strong>#InternationalCatDay</strong><br><small class="text-muted">Cats are trending 🐱</small></p>
                <a href="#" class="text-decoration-none">Show more</a>
            </div>
        </div>
    </div>
</div>
@endsection --}}
