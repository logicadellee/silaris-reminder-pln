@props(['align' => 'right', 'contentClasses' => ''])

@php
$alignmentClasses = $align === 'left' ? 'dropdown-menu-start' : 'dropdown-menu-end';
@endphp

<div class="position-relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div
        x-show="open"
        x-transition
        class="dropdown-menu show position-absolute mt-2 {{ $alignmentClasses }} {{ $contentClasses }}"
        @click="open = false"
    >
        {{ $content }}
    </div>
</div>
