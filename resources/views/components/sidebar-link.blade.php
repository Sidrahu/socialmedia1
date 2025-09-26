@props(['icon', 'label'])

<li class="nav-item">
    <a href="#" class="nav-link d-flex align-items-center gap-3 p-2 text-dark rounded hover-bg-light">
        <i class="{{ $icon }} fs-5"></i>
        <span>{{ $label }}</span>
    </a>
</li>
