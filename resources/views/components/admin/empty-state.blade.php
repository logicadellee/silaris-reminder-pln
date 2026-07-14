@props(['title', 'description' => null, 'icon' => 'info-circle'])

<div class="text-center py-5">
    <div class="text-body-secondary mb-3">
        <i class="bi bi-{{ $icon }} fs-1"></i>
    </div>
    <h3 class="h5 fw-semibold mb-2">{{ $title }}</h3>
    @if ($description)
        <p class="text-body-secondary mb-0">{{ $description }}</p>
    @endif
</div>
