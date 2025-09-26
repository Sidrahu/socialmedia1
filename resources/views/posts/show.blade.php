{{-- resources/views/posts/show.blade.php --}}
<x-app-layout>
    <div class="max-w-2xl mx-auto py-10">
        <h2 class="text-2xl font-semibold mb-4">Post by {{ $post->user->name }}</h2>
        <p class="text-gray-700 mb-4">{{ $post->content }}</p>

        @if ($post->media_path)
            @if ($post->media_type === 'image')
                <img src="{{ asset('storage/' . $post->media_path) }}" class="rounded w-full mb-4" />
            @elseif ($post->media_type === 'video')
                <video controls class="w-full rounded mb-4">
                    <source src="{{ asset('storage/' . $post->media_path) }}" type="video/mp4">
                </video>
            @endif
        @endif

        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline">← Back to Feed</a>
    </div>
</x-app-layout>
