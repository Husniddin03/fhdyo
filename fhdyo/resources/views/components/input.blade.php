@props([
    'label' => null,
    'name' => null,
    'type' => 'text',
    'value' => null,
    'hint' => null,
    'error' => null,
])

@php
    $inputId = $attributes->get('id') ?? $name;
    $hasError = (bool) ($error ?? ($name ? $errors->has($name) : false));
    $errorText = $error ?? ($name ? $errors->first($name) : null);
@endphp

<div class="w-full">
    @if ($label)
        <label for="{{ $inputId }}" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">
            {{ $label }}
        </label>
    @endif

    <div class="relative">
        <input
            {{ $attributes->merge([
                'id' => $inputId,
                'name' => $name,
                'type' => $type,
                'value' => old($name, $value),
                'class' => implode(' ', [
                    'w-full rounded-2xl border bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition',
                    'placeholder:text-slate-400 focus:bg-white/80 focus:ring-2 dark:bg-slate-950/40 dark:text-white dark:placeholder:text-slate-500 dark:focus:bg-slate-950/60',
                    $hasError
                        ? 'border-rose-300 focus:border-rose-400 focus:ring-rose-500/20 dark:border-rose-500/40 dark:focus:border-rose-400'
                        : 'border-white/30 focus:border-indigo-300 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:focus:border-indigo-500/50',
                ]),
            ]) }} />

        @if ($hasError)
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-rose-500">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 9v4.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    <path d="M12 17.25h.008v.008H12v-.008Z" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" />
                    <path
                        d="M10.29 3.86c.72-1.27 2.54-1.27 3.26 0l8.18 14.45c.71 1.25-.19 2.79-1.63 2.79H3.74c-1.44 0-2.34-1.54-1.63-2.79L10.29 3.86Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>
        @endif
    </div>

    @if ($hint && !$hasError)
        <div class="mt-2 text-xs text-slate-500 dark:text-slate-400">{{ $hint }}</div>
    @endif

    @if ($hasError && $errorText)
        <div class="mt-2 text-xs font-medium text-rose-600 dark:text-rose-300">{{ $errorText }}</div>
    @endif
</div>
