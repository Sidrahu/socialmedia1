<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Post;
use App\Models\Message;
use App\Events\NewMessage;
use App\Livewire\UserProfile;
use App\Livewire\NewsViewPage;
use App\Livewire\LikesPage;
use Chatify\Http\Controllers\MessagesController;

// ✅ Public routes
Route::view('/', 'welcome');

Route::get('/post/{post}', function (Post $post) {
    return view('posts.show', compact('post'));
})->name('post.show');

// Route::get('/hashtag/{tag}', function ($tag) {
//     $posts = Post::where('content', 'LIKE', "%#{$tag}%")->latest()->get();
//     return view('hashtag', compact('posts', 'tag'));
// });

Route::get('/profile/{user}', UserProfile::class)->name('profile.show');
Route::get('/news/{slug}', NewsViewPage::class)->name('news.view');

// ✅ Authenticated routes
Route::middleware(['auth'])->group(function () {

    Route::view('/dashboard', 'dashboard')->middleware('verified')->name('dashboard');

    Route::get('/profile', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::put('/profile', function (Request $request) {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'bio'   => 'nullable|string|max:1000',
            'profile_photo' => 'nullable|image|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'bio' => $request->bio
        ]);

        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    })->name('profile.update');

    Route::get('/notifications', function () {
        $notifications = auth()->user()->notifications;
        auth()->user()->unreadNotifications->markAsRead();
        return view('livewire.notifications', compact('notifications'));
    })->name('notifications');

    Route::get('/feed', function () {
        $posts = Post::with('user')->latest()->get();
        return view('social_feed', compact('posts'));
    })->name('feed');

    Route::get('/chatify', [MessagesController::class, 'index'])->name('chatify');

    Route::get('/likes', function () {
        $likes = \App\Models\Like::whereHas('post', fn($q) => $q->where('user_id', auth()->id()))
            ->latest()->with('user', 'post')->get();
        return view('likes.index', compact('likes'));
    })->name('likes');

    Route::get('/test-broadcast', function () {
        $message = Message::latest()->first();
        if (! $message) return "No message found in DB. Please create one first.";
        broadcast(new NewMessage($message));
        return "✅ Message broadcasted successfully!";
    });
});


Route::post('/notifications/read', function () {
    $user = auth()->user();
    if ($user) {
        $user->unreadNotifications->markAsRead();
    }
    return response()->json(['status' => 'ok']);
})->middleware('auth')->name('notifications.read');

Route::get('/hashtag/{tag}', function ($tag) {
    $tagModel = Tag::where('name', $tag)->firstOrFail();
    $posts = $tagModel->posts()->latest()->paginate(10);
    return view('hashtags.show', compact('tagModel', 'posts'));
})->name('hashtag.show');




Route::get('/likes', LikesPage::class)->name('likes');



// ✅ Auth routes (login, register, logout, etc.)
require __DIR__.'/auth.php';
