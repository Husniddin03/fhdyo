@props([
    'columns' => [],
    'striped' => true,
    'hover' => true,
    'loading' => false,
    'empty' => false,
    'emptyTitle' => 'No data',
    'emptySubtitle' => 'There is nothing to show yet.',
    'emptyIcon' => 'inbox',
    'cardOnMobile' => true,
])

<x-card class="overflow-hidden p-0">
    <div class="overflow-x-auto">
        <table class="min-w-full text-left">
            <thead class="bg-white/40 dark:bg-slate-950/30">
                <tr>
                    @foreach ($columns as $col)
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">
                            {{ $col }}
                        </th>
                    @endforeach
                </tr>
            </thead>

            <tbody class="divide-y divide-white/20 bg-white/20 dark:divide-slate-800/60 dark:bg-slate-950/10">
                @if ($loading)
                    @for ($i = 0; $i < 6; $i++)
                        <tr class="{{ $hover ? 'hover:bg-white/30 dark:hover:bg-white/5' : '' }}">
                            @foreach ($columns as $col)
                                <td class="px-6 py-4">
                                    <div class="h-4 w-full animate-pulse rounded-xl bg-slate-900/10 dark:bg-white/10"></div>
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                @elseif ($empty)
                    <tr>
                        <td class="px-6 py-10" colspan="{{ max(count($columns), 1) }}">
                            <div class="mx-auto max-w-md text-center">
                                <div class="mx-auto grid h-12 w-12 place-items-center rounded-2xl bg-slate-900/5 text-slate-700 dark:bg-white/5 dark:text-slate-200">
                                    @if ($emptyIcon === 'users')
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 19.128c.851.196 1.67.476 2.448.835A8.967 8.967 0 0 0 21 12.75C21 7.78 16.97 3.75 12 3.75S3 7.78 3 12.75c0 3.146 1.618 5.914 4.065 7.5.777-.36 1.596-.64 2.448-.835" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            <path d="M12 12.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    @else
                                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 7.5h18M3 12h18M3 16.5h18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="mt-4 text-sm font-semibold text-slate-900 dark:text-white">{{ $emptyTitle }}</div>
                                <div class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ $emptySubtitle }}</div>
                            </div>
                        </td>
                    </tr>
                @else
                    {{ $slot }}
                @endif
            </tbody>
        </table>
    </div>
</x-card>

@if ($cardOnMobile)
    <div class="mt-4 space-y-4 sm:hidden">
        {{ $mobile ?? '' }}
    </div>
@endif
