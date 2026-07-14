@props(['title', 'description' => null, 'class' => ''])

<div class="card border-0 shadow-sm {{ $class }}">
    <div class="card-body">
        @if ($title)
            <div class="d-flex align-items-center justify-content-between gap-3 mb-3">
                <div>
                    <h2 class="h5 fw-semibold mb-1">{{ $title }}</h2>
                    @if ($description)
                        <p class="text-body-secondary small mb-0">{{ $description }}</p>
                    @endif
                </div>
            </div>
        @endif

        {{ $slot }}
    </div>
</div>
