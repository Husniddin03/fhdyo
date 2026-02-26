@props([
    'variant' => 'soft',
    'color' => 'slate',
])

@php
    $base = 'inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold ring-1 ring-inset';

    $map = [
        'soft' => [
            'slate' => 'bg-slate-900/5 text-slate-700 ring-slate-900/10 dark:bg-white/5 dark:text-slate-200 dark:ring-white/10',
            'indigo' => 'bg-indigo-500/10 text-indigo-700 ring-indigo-500/20 dark:text-indigo-200',
            'emerald' => 'bg-emerald-500/10 text-emerald-700 ring-emerald-500/20 dark:text-emerald-200',
            'amber' => 'bg-amber-500/10 text-amber-800 ring-amber-500/20 dark:text-amber-200',
            'rose' => 'bg-rose-500/10 text-rose-700 ring-rose-500/20 dark:text-rose-200',
        ],
    ];

    $classes = $map[$variant][$color] ?? $map['soft']['slate'];
@endphp

<span {{ $attributes->merge(['class' => $base . ' ' . $classes]) }}>
    {{ $slot }}
</span>
