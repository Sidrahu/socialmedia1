<div class="comment-section mt-4">
    <!-- ✅ Add Comment Form -->
    <form wire:submit.prevent="addComment" class="comment-form">
        <div class="comment-input-wrapper">
            <input type="text" wire:model="commentText" class="comment-input" placeholder="Write a comment...">
            <button type="submit" class="comment-btn">Post</button>
        </div>
        @error('commentText')
            <p class="error-text">{{ $message }}</p>
        @enderror
    </form>

    <!-- ✅ Comments List -->
    <div class="comments-list mt-4">
        @forelse ($comments as $comment)
            <div class="comment-item">
                <div class="comment-avatar">
                    <img src="{{ $comment->user->profile_photo_url ?? asset('images/default-avatar.png') }}" alt="{{ $comment->user->name }}">
                </div>
                <div class="comment-content">
                    <div class="comment-header">
                        <strong class="comment-author">{{ $comment->user->name }}</strong>
                        <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="comment-text">{{ $comment->comment }}</p>
                </div>
            </div>
        @empty
            <p class="no-comments">No comments yet. Be the first to comment!</p>
        @endforelse
    </div>


<style>
    /* Comment Section */
.comment-section {
    background: #fff;
    border-radius: 12px;
    padding: 16px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}

/* Add Comment Form */
.comment-form {
    display: flex;
    flex-direction: column;
}
.comment-input-wrapper {
    display: flex;
    align-items: center;
    background: #f9fafb;
    border-radius: 30px;
    padding: 6px 10px;
    box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.03);
}
.comment-input {
    flex: 1;
    border: none;
    outline: none;
    background: transparent;
    padding: 10px 14px;
    font-size: 14px;
}
.comment-btn {
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    color: #fff;
    border: none;
    padding: 10px 18px;
    border-radius: 25px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s;
}
.comment-btn:hover {
    background: linear-gradient(135deg, #6366f1, #4f46e5);
    transform: translateY(-1px);
}
.error-text {
    color: #ef4444;
    font-size: 13px;
    margin-top: 4px;
}

/* Comments List */
.comments-list {
    margin-top: 16px;
}
.comment-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f1f5f9;
    transition: background 0.2s;
}
.comment-item:hover {
    background: #f9fafb;
    border-radius: 8px;
}
.comment-avatar img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #e5e7eb;
}
.comment-content {
    flex: 1;
}
.comment-header {
    display: flex;
    justify-content: space-between;
    font-size: 14px;
}
.comment-author {
    font-weight: 600;
    color: #111827;
}
.comment-time {
    font-size: 12px;
    color: #6b7280;
}
.comment-text {
    margin-top: 4px;
    font-size: 14px;
    color: #374151;
}
.no-comments {
    text-align: center;
    color: #6b7280;
    font-size: 14px;
    margin-top: 16px;
}
</style>
</div>