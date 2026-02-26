@props([
    'as' => 'div',
    'class' => '',
])

<{{ $as }} {{ $attributes->merge(['class' => "rounded-2xl border border-white/30 bg-white/55 shadow-xl shadow-black/5 backdrop-blur-xl transition duration-200 ease-in-out dark:border-slate-800/60 dark:bg-slate-950/40 {$class}"]) }}>
    {{ $slot }}
</{{ $as }}>
