<div>
   <div class="card p-3 shadow-sm mb-4">
    {{-- 🔍 Search Input --}}
    <div class="input-group">
        <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
        <input type="text" wire:model.debounce.500ms="search" class="form-control" placeholder="Search users...">
    </div>

    {{-- 👥 Results --}}
    @if (!empty($results))
        <div class="list-group mt-2">
            @foreach ($results as $user)
                <a href="{{ route('profile.show', $user->id) }}" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                        <img src="{{ $user->profile_photo_url }}" class="rounded-circle me-2" width="32" height="32">
                        <div>{{ $user->name }}</div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif
</div>

</div>
