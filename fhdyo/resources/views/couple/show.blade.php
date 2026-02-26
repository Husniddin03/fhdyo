@extends('layouts.app')

@section('title', 'Couple')
@section('nav', 'couple')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Couple</h1>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Couple details, status and results.</p>
            </div>

            <a href="{{ route('couples.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-white/60 px-5 py-2.5 text-sm font-semibold text-slate-800 shadow-sm shadow-black/5 ring-1 ring-white/30 transition hover:bg-white/80 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/30 dark:bg-slate-950/40 dark:text-slate-100 dark:ring-slate-800/60 dark:hover:bg-slate-950/60 w-full sm:w-auto">
                <span>Back</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_20rem]">
            <x-card class="p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold tracking-tight text-slate-900 dark:text-white">Overview</h2>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Basic couple info.</p>
                    </div>

                    <div class="relative">
                        <button onclick="toggleDropdown(this)"
                            class="inline-flex items-center justify-center rounded-xl p-2 text-slate-700 transition hover:bg-slate-900/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/30 dark:text-slate-200 dark:hover:bg-white/5"
                            type="button" aria-label="Actions">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 12h.01M12 12h.01M19 12h.01" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" />
                            </svg>
                        </button>

                        <div
                            class="hidden absolute right-0 mt-2 w-40 overflow-hidden rounded-xl border border-white/20 bg-white/80 shadow-lg shadow-black/10 backdrop-blur-xl dark:border-slate-800/60 dark:bg-slate-950/70 z-50">
                            <ul class="flex flex-col text-sm">
                                <li>
                                    <a href="{{ route('couples.edit', $couple->id) }}"
                                        class="block px-4 py-2 font-semibold text-slate-700 hover:bg-slate-900/5 dark:text-slate-200 dark:hover:bg-white/5">✏️
                                        Tahrirlash</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('couples.destroy', $couple->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete this couple?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full px-4 py-2 text-left font-semibold text-red-600 hover:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/10">🗑️
                                            O'chirish</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <dl class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Husband</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                            {{ $couple->husbandData ? $couple->husbandData->first_name . ' ' . $couple->husbandData->middle_name . ' ' . $couple->husbandData->last_name : 'N/A' }}
                        </dd>
                        <dd class="mt-1 text-xs text-slate-500 dark:text-slate-400">Key: {{ $couple->husband_key }}</dd>
                    </div>

                    <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Wife</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">
                            {{ $couple->wifeData ? $couple->wifeData->first_name . ' ' . $couple->wifeData->middle_name . ' ' . $couple->wifeData->last_name : 'N/A' }}
                        </dd>
                        <dd class="mt-1 text-xs text-slate-500 dark:text-slate-400">Key: {{ $couple->wife_key }}</dd>
                    </div>

                    <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Created At</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $couple->created_at->format('Y-m-d H:i') }}</dd>
                    </div>

                    <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                        <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">User</dt>
                        <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $couple->user ? $couple->user->name : 'N/A' }}</dd>
                    </div>
                </dl>
            </x-card>

            <x-card class="p-6 sm:p-8">
                <h2 class="text-lg font-semibold tracking-tight text-slate-900 dark:text-white">Status</h2>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Current relationship status and overall score.</p>

                <div class="mt-5 space-y-4">
                    <div>
                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Status</div>
                        <div class="mt-2">
                            <span
                                class="inline-flex items-center rounded-full px-3 py-1 text-xs font-semibold {{ $couple->status === 'married' ? 'bg-emerald-500/10 text-emerald-700 dark:text-emerald-200' : ($couple->status === 'divorced' ? 'bg-red-500/10 text-red-700 dark:text-red-300' : 'bg-amber-500/10 text-amber-700 dark:text-amber-200') }}">
                                {{ ucfirst($couple->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="relative">
                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Result</div>
                        <button onclick="toggleResultsDropdown(this)" type="button"
                            class="mt-2 inline-flex w-full items-center justify-between gap-3 rounded-xl border border-white/20 bg-white/40 px-4 py-2.5 text-sm font-semibold text-slate-900 shadow-sm shadow-black/5 transition hover:bg-white/60 dark:border-slate-800/60 dark:bg-slate-950/20 dark:text-white dark:hover:bg-slate-950/35">
                            <span>{{ $couple->result ? number_format($couple->result, 1) . '%' : 'N/A' }}</span>
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 0 1 1.06.02L10 11.168l3.71-3.938a.75.75 0 1 1 1.08 1.04l-4.24 4.5a.75.75 0 0 1-1.08 0l-4.24-4.5a.75.75 0 0 1 .02-1.06Z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        @if ($couple->results->count() > 0)
                            <div
                                class="hidden absolute right-0 mt-2 w-full overflow-hidden rounded-xl border border-white/20 bg-white/85 shadow-lg shadow-black/10 backdrop-blur-xl dark:border-slate-800/60 dark:bg-slate-950/70 z-100">
                                <div class="p-4">
                                    <h4 class="text-sm font-semibold text-slate-900 dark:text-white">Results by Category</h4>
                                    <ul class="mt-3 space-y-2">
                                        @foreach ($couple->results as $result)
                                            <li class="flex items-center justify-between gap-3 text-sm">
                                                <span class="text-slate-700 dark:text-slate-200">{{ $result->category->category ?? 'Category' }}:</span>
                                                <span class="font-semibold text-indigo-700 dark:text-indigo-200">{{ number_format($result->percent, 1) }}%</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </x-card>
        </div>

        <x-card class="p-0 overflow-hidden">
            <div class="border-b border-white/20 px-6 py-4 dark:border-slate-800/60">
                <h2 class="text-sm font-semibold text-slate-900 dark:text-white">Answers</h2>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Answers for this couple.</p>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-white/40 dark:bg-slate-950/30">
                        <tr>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">{{ $couple->husbandData ? $couple->husbandData->first_name . ' ' . $couple->husbandData->middle_name . ' ' . $couple->husbandData->last_name : 'N/A' }}</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">{{ $couple->wifeData ? $couple->wifeData->first_name . ' ' . $couple->wifeData->middle_name . ' ' . $couple->wifeData->last_name : 'N/A' }}</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Questions</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Category</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/20 bg-white/20 dark:divide-slate-800/60 dark:bg-slate-950/10">
                        @foreach ($answers as $answer)
                            <tr class="transition hover:bg-white/30 dark:hover:bg-white/5">
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ $answer['husband'] === 0 ? 'No' : ($answer['husband'] == 1 ? 'Yes' : 'Unanswered') }}
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ $answer['wife'] === 0 ? 'No' : ($answer['wife'] == 1 ? 'Yes' : 'Unanswered') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-200">{{ $answer['question'] }}</td>
                                <td class="px-6 py-4 text-sm text-slate-700 dark:text-slate-200">{{ $answer['category'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </x-card>
    </div>
@endsection

<script>
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;

        // Close all other dropdowns first
        document.querySelectorAll('.absolute.right-0.mt-8').forEach(d => {
            if (d !== dropdown) {
                d.classList.add('hidden');
            }
        });

        dropdown.classList.toggle('hidden');

        // Close when clicking outside
        if (!dropdown.classList.contains('hidden')) {
            setTimeout(() => {
                document.addEventListener('click', function closeDropdown(e) {
                    if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                        dropdown.classList.add('hidden');
                        document.removeEventListener('click', closeDropdown);
                    }
                });
            }, 0);
        }
    }

    function toggleResultsDropdown(button) {
        const dropdown = button.nextElementSibling;

        // Close all other result dropdowns first
        document.querySelectorAll('.absolute.right-0.mt-2').forEach(d => {
            if (d !== dropdown) {
                d.classList.add('hidden');
            }
        });

        if (dropdown) {
            dropdown.classList.toggle('hidden');

            // Close when clicking outside
            if (!dropdown.classList.contains('hidden')) {
                setTimeout(() => {
                    document.addEventListener('click', function closeResultsDropdown(e) {
                        if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                            dropdown.classList.add('hidden');
                            document.removeEventListener('click', closeResultsDropdown);
                        }
                    });
                }, 0);
            }
        }
    }
</script>
