@props([
    'type' => 'info',
    'title' => null,
])

@php
    $map = [
        'info' => [
            'wrap' => 'border-indigo-500/20 bg-indigo-500/10',
            'icon' => 'text-indigo-700 dark:text-indigo-200',
        ],
        'success' => [
            'wrap' => 'border-emerald-500/20 bg-emerald-500/10',
            'icon' => 'text-emerald-700 dark:text-emerald-200',
        ],
        'warning' => [
            'wrap' => 'border-amber-500/20 bg-amber-500/10',
            'icon' => 'text-amber-800 dark:text-amber-200',
        ],
        'danger' => [
            'wrap' => 'border-rose-500/20 bg-rose-500/10',
            'icon' => 'text-rose-700 dark:text-rose-200',
        ],
    ];

    $c = $map[$type] ?? $map['info'];
@endphp

<div {{ $attributes->merge(['class' => "rounded-2xl border p-4 shadow-sm shadow-black/5 {$c['wrap']} dark:border-slate-800/60"]) }}>
    <div class="flex gap-3">
        <div class="mt-0.5 grid h-10 w-10 place-items-center rounded-2xl bg-white/40 dark:bg-slate-950/40 {{ $c['icon'] }}">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                @if ($type === 'success')
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 4.5 4.5 10.5-10.5" />
                @elseif ($type === 'warning')
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m0 3h.008v.008H12v-.008Z" />
                @elseif ($type === 'danger')
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                @else
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25h1.5v4.5h-1.5v-4.5Zm0-3h1.5v1.5h-1.5V8.25Z" />
                @endif
            </svg>
        </div>

        <div class="min-w-0 flex-1">
            @if ($title)
                <div class="text-sm font-semibold text-slate-900 dark:text-white">{{ $title }}</div>
            @endif
            <div class="text-sm text-slate-700 dark:text-slate-300">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
