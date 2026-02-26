@props([
    'variant' => 'solid',
    'color' => 'indigo',
    'size' => 'lg',
    'type' => 'button',
    'href' => null,
])

@php
    $sizes = [
        'sm' => 'px-3 py-2 text-sm rounded-xl',
        'md' => 'px-4 py-2.5 text-sm rounded-2xl',
        'lg' => 'px-5 py-3 text-sm rounded-2xl',
    ];

    $solid = [
        'indigo' => 'bg-indigo-600 text-white hover:bg-indigo-500 focus-visible:ring-indigo-500',
        'slate' => 'bg-slate-900 text-white hover:bg-slate-800 focus-visible:ring-slate-700',
        'danger' => 'bg-rose-600 text-white hover:bg-rose-500 focus-visible:ring-rose-500',
        'success' => 'bg-emerald-600 text-white hover:bg-emerald-500 focus-visible:ring-emerald-500',
        'warning' => 'bg-amber-500 text-white hover:bg-amber-400 focus-visible:ring-amber-400',
    ];

    $soft = [
        'indigo' => 'bg-indigo-500/10 text-indigo-800 hover:bg-indigo-500/15 focus-visible:ring-indigo-500 dark:text-indigo-200',
        'slate' => 'bg-slate-900/5 text-slate-900 hover:bg-slate-900/10 focus-visible:ring-slate-500 dark:bg-white/5 dark:text-white dark:hover:bg-white/10',
        'danger' => 'bg-rose-500/10 text-rose-700 hover:bg-rose-500/15 focus-visible:ring-rose-500 dark:text-rose-200',
        'success' => 'bg-emerald-500/10 text-emerald-700 hover:bg-emerald-500/15 focus-visible:ring-emerald-500 dark:text-emerald-200',
        'warning' => 'bg-amber-500/10 text-amber-800 hover:bg-amber-500/15 focus-visible:ring-amber-500 dark:text-amber-200',
    ];

    $ghost = [
        'indigo' => 'text-indigo-700 hover:bg-indigo-500/10 focus-visible:ring-indigo-500 dark:text-indigo-200',
        'slate' => 'text-slate-700 hover:bg-slate-900/5 focus-visible:ring-slate-500 dark:text-slate-200 dark:hover:bg-white/5',
        'danger' => 'text-rose-700 hover:bg-rose-500/10 focus-visible:ring-rose-500 dark:text-rose-200',
        'success' => 'text-emerald-700 hover:bg-emerald-500/10 focus-visible:ring-emerald-500 dark:text-emerald-200',
        'warning' => 'text-amber-700 hover:bg-amber-500/10 focus-visible:ring-amber-500 dark:text-amber-200',
    ];

    $variantMap = [
        'solid' => $solid,
        'soft' => $soft,
        'ghost' => $ghost,
    ];

    $base = 'inline-flex items-center gap-2 justify-center font-semibold shadow-sm transition duration-200 ease-in-out focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 focus-visible:ring-offset-white dark:focus-visible:ring-offset-slate-950 disabled:opacity-60 disabled:pointer-events-none';
    $ring = 'border border-white/20 dark:border-slate-800/60';

    $sizeClass = $sizes[$size] ?? $sizes['lg'];
    $colorClass = ($variantMap[$variant][$color] ?? $variantMap['solid']['indigo']);

    $classes = trim("{$base} {$sizeClass} {$ring} {$colorClass}");
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
