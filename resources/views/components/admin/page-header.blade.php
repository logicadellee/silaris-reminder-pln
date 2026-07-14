@props(['title', 'description' => null])

<div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
    <div>
        <h1 class="h3 fw-semibold mb-1">{{ $title }}</h1>
        @if ($description)
            <p class="text-body-secondary mb-0">{{ $description }}</p>
        @endif
    </div>
</div>
