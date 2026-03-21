@props(['align' => 'right', 'width' => '48', 'contentClasses' => ''])
@php
$alignmentClasses = match($align) {
    'left'   => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top'    => 'origin-top',
    default  => 'ltr:origin-top-right rtl:origin-top-left end-0',
};
$widthClass = 'w-'.$width;
@endphp
<div class="relative" x-data="{open: false}" @click.outside="open=false" @close.stop="open=false">
    <div @click="open=!open">{{ $trigger }}</div>
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="{{ $widthClass }} {{ $alignmentClasses }} absolute z-50 mt-1 rounded-xl border border-slate-200 bg-white shadow-lg {{ $contentClasses }}"
        style="display:none"
        @click="open=false"
    >{{ $content }}</div>
</div>
