@php
    if ($post && $post instanceof \App\Models\Post && $post->exists) {
        $postUrl   = route('post.show', $post);
        $encoded   = urlencode($postUrl);
        $shareText = urlencode("Check this post: $postUrl");
    } else {
        $postUrl   = '#';
        $encoded   = '';
        $shareText = '';
    }
@endphp

<div x-data="{ shareOpen: false }" class="post-actions mt-3">
    <div class="d-flex justify-content-start align-items-center gap-3 flex-wrap">

        {{-- ❤️ Like --}}
        <button type="button" wire:click="toggleLike" 
            class="action-btn {{ $isLiked ? 'active-like' : '' }}">
            <i class="bi bi-heart{{ $isLiked ? '-fill' : '' }}"></i>
            <span>{{ $post->likes_count ?? $post->likes->count() }}</span>
        </button>

        {{-- 💬 Comment --}}
        <a href="{{ $postUrl }}#comments" class="action-btn">
            <i class="bi bi-chat-dots"></i>
            <span>{{ $post->comments_count ?? $post->comments->count() }}</span>
        </a>

        {{-- 🔗 Share --}}
        <button type="button" @click="shareOpen = !shareOpen" class="action-btn" title="Share">
            <i class="bi bi-share"></i>
        </button>

        {{-- 🗑️ Delete (Only Post Owner) --}}
        @if ($post->user_id === auth()->id())
            <button type="button" wire:click="deletePost" class="action-btn delete-btn" title="Delete Post">
                <i class="bi bi-trash"></i>
            </button>
        @endif
    </div>

    {{-- ✅ Social Share Icons --}}
    <div x-show="shareOpen" x-transition class="share-icons mt-3">
        <a href="https://api.whatsapp.com/send?text={{ $shareText }}" class="social-btn whatsapp" title="Share on WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ $encoded }}" class="social-btn facebook" title="Share on Facebook">
            <i class="bi bi-facebook"></i>
        </a>
        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $encoded }}" class="social-btn linkedin" title="Share on LinkedIn">
            <i class="bi bi-linkedin"></i>
        </a>
        <button type="button" onclick="copyLink('{{ $postUrl }}')" class="social-btn copy-link" title="Copy Link">
            <i class="bi bi-link-45deg"></i>
        </button>
    </div>


<script>
function copyLink(url) {
    navigator.clipboard.writeText(url);
    const tooltip = document.createElement('div');
    tooltip.textContent = 'Link Copied!';
    tooltip.style.position = 'fixed';
    tooltip.style.bottom = '20px';
    tooltip.style.left = '50%';
    tooltip.style.transform = 'translateX(-50%)';
    tooltip.style.background = '#111';
    tooltip.style.color = '#fff';
    tooltip.style.padding = '8px 14px';
    tooltip.style.borderRadius = '6px';
    tooltip.style.zIndex = '9999';
    document.body.appendChild(tooltip);
    setTimeout(() => tooltip.remove(), 1500);
}
</script>
<style>
    .post-actions {
    display: flex;
    flex-direction: column;
}

.action-btn {
    background: #f9fafb;
    border: none;
    padding: 10px 16px;
    border-radius: 30px;
    font-size: 15px;
    display: flex;
    align-items: center;
    gap: 6px;
    color: #374151;
    font-weight: 500;
    transition: all 0.3s ease;
    cursor: pointer;
}
.action-btn i {
    font-size: 18px;
}
.action-btn:hover {
    background: #eef2ff;
    color: #2563eb;
    transform: translateY(-2px);
}
.active-like {
    background: #fee2e2;
    color: #ef4444;
}
.delete-btn:hover {
    background: #fee2e2;
    color: #dc2626;
}

/* ✅ Social Share Buttons */
.share-icons {
    display: flex;
    gap: 10px;
}
.social-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    font-size: 18px;
    color: #fff;
    transition: transform 0.3s;
}
.social-btn:hover {
    transform: scale(1.15);
}
.whatsapp { background: #25d366; }
.facebook { background: #1877f2; }
.linkedin { background: #0077b5; }
.copy-link { background: #6b7280; }

    </style>
    </div>