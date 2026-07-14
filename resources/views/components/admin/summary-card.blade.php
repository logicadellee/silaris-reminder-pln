@props(['title', 'value', 'icon', 'tone' => 'primary'])

<div class="col-md-6 col-xl-3">
    <div class="card border-0 shadow-sm h-100">
        <div class="card-body d-flex justify-content-between align-items-start gap-3">
            <div>
                <p class="text-body-secondary small mb-2">{{ $title }}</p>
                <h2 class="h4 fw-semibold mb-0">{{ $value }}</h2>
            </div>
            <div class="rounded-circle bg-{{ $tone }} bg-opacity-10 p-3 text-{{ $tone }}">
                <i class="bi bi-{{ $icon }} fs-5"></i>
            </div>
        </div>
    </div>
</div>
