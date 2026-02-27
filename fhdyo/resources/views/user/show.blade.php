@extends('layouts.app')

@section('title', 'Admin')
@section('nav', 'admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Admin</h1>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Admin details and created couples.</p>
            </div>

            <a href="{{ route('users.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-white/60 px-5 py-2.5 text-sm font-semibold text-slate-800 shadow-sm shadow-black/5 ring-1 ring-white/30 transition hover:bg-white/80 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/30 dark:bg-slate-950/40 dark:text-slate-100 dark:ring-slate-800/60 dark:hover:bg-slate-950/60 w-full sm:w-auto">
                <span>Back</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
        </div>

        <x-card class="p-6 sm:p-8">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-lg font-semibold tracking-tight text-slate-900 dark:text-white">Overview</h2>
                    <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Account information.</p>
                </div>

                @if (Auth::user()->role == 'super_admin')
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
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="block px-4 py-2 font-semibold text-slate-700 hover:bg-slate-900/5 dark:text-slate-200 dark:hover:bg-white/5">✏️
                                        Tahrirlash</a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('users.destroy', $user->id) }}"
                                        onsubmit="return confirm('Are you sure you want to delete selected users?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full px-4 py-2 text-left font-semibold text-red-600 hover:bg-red-500/10 dark:text-red-400 dark:hover:bg-red-500/10">🗑️
                                            O‘chirish</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
            </div>

            <dl class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Full name</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $user->name }}</dd>
                </div>
                <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Email</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $user->email }}</dd>
                </div>
                <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Role</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $user->role }}</dd>
                </div>
                <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Gender</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $user->userData->gender ?? '-' }}</dd>
                </div>
                <div class="rounded-2xl border border-white/20 bg-white/40 p-4 dark:border-slate-800/60 dark:bg-slate-950/20">
                    <dt class="text-xs font-semibold uppercase tracking-wider text-slate-600 dark:text-slate-300">Birthday</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-900 dark:text-white">{{ $user->userData->birthday ?? '-' }}</dd>
                </div>
            </dl>
        </x-card>

        <x-card class="p-0 overflow-hidden">
            <div class="border-b border-white/20 px-6 py-4 dark:border-slate-800/60">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h2 class="text-base font-semibold tracking-tight text-slate-900 dark:text-white">This user created couples</h2>
                        <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Manage couples created by this user.</p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center sm:justify-end">
                        <form id="bulkDeleteForm" method="POST" action="{{ route('couples.destroy', -1) }}"
                            onsubmit="return confirm('Are you sure you want to delete selected couples?');"
                            class="hidden inline-flex items-center justify-center gap-2 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-red-500/30 transition hover:bg-red-700">
                            @csrf
                            @method('DELETE')
                            <div id="selectedInputs"></div>
                            <button type="submit">
                                Delete selected
                            </button>
                        </form>

                        <a href="{{ route('couples.create') }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm shadow-emerald-500/30 transition hover:bg-emerald-700">
                            <span>Add couple</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </a>

                        <a href="{{ route('users.show', $user->id) }}"
                            class="inline-flex items-center justify-center gap-2 rounded-xl bg-white/60 px-4 py-2.5 text-sm font-semibold text-slate-800 shadow-sm shadow-black/5 ring-1 ring-white/30 transition hover:bg-white/80 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/30 dark:bg-slate-950/40 dark:text-slate-100 dark:ring-slate-800/60 dark:hover:bg-slate-950/60">
                            <span>Clear filter</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-5 w-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                            </svg>
                        </a>

                        <form method="GET" action="{{ route('couples.destroy', -1) }}" class="inline-flex items-center gap-2">
                            <h4 class="text-sm font-semibold text-slate-700 dark:text-slate-200">Per page</h4>
                            @foreach (request()->except('per_page') as $key => $value)
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endforeach
                            <select name="per_page" onchange="this.form.submit()"
                                class="rounded-xl border border-white/20 bg-white/60 px-3 py-2 text-sm font-semibold text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:ring-2 focus:ring-indigo-500/30 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white">
                                @for ($i = 10; $i <= $count; $i += 10)
                                    <option value="{{ $i }}" {{ request()->get('per_page') == $i ? 'selected' : '' }}>
                                        {{ $i }}</option>
                                @endfor
                                <option {{ request()->get('per_page') == $count ? 'selected' : '' }} value="{{ $count }}">
                                    All
                                </option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <!-- Table -->
                <table class="w-full text-left min-w-[1400px]">
                    <!-- Head -->
                    <thead class="bg-white/40 dark:bg-slate-950/30">
                        <tr>
                            <th class="py-4 px-5 w-[5%]">
                                <input type="checkbox" id="allCheckbox"
                                    class="h-5 w-5 rounded-lg border border-slate-300 bg-white text-indigo-600 focus:ring-2 focus:ring-indigo-500/30 dark:border-slate-700 dark:bg-slate-900" />
                            </th>
                            <th class="py-4 px-5 w-[18%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-slate-700 dark:text-slate-200 flex items-center gap-2">
                                            <span>Husband</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="husband_sort"
                                                    value="{{ request('husband_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('husband_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('husband_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('users.show', $user->id) }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('husband') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                                <path
                                                    d="M14 14l-3.465-3.465M10.535 10.535A5 5 0 1 0 2 7a5 5 0 0 0 8.535 3.535Z"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <input type="text" name="husband"
                                                class="bg-white/70 dark:bg-slate-950/30 p-2 pl-8 text-sm border rounded-xl border-white/20 dark:border-slate-800/60 w-full focus:ring-2 focus:ring-indigo-500/30 outline-none text-slate-900 dark:text-white placeholder:text-slate-400"
                                                placeholder="Search husband..."
                                                value="{{ request('husband') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('husband'))
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except('husband') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-slate-500 hover:text-red-600 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[18%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-slate-700 dark:text-slate-200 flex items-center gap-2">
                                            <span>Wife</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="wife_sort"
                                                    value="{{ request('wife_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('wife_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('wife_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('users.show', $user->id) }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('wife') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                                <path
                                                    d="M14 14l-3.465-3.465M10.535 10.535A5 5 0 1 0 2 7a5 5 0 0 0 8.535 3.535Z"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <input type="text" name="wife"
                                                class="bg-white/70 dark:bg-slate-950/30 p-2 pl-8 text-sm border rounded-xl border-white/20 dark:border-slate-800/60 w-full focus:ring-2 focus:ring-indigo-500/30 outline-none text-slate-900 dark:text-white placeholder:text-slate-400"
                                                placeholder="Search wife..." value="{{ request('wife') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('wife'))
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except('wife') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-slate-500 hover:text-red-600 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-slate-700 dark:text-slate-200 flex items-center gap-2">
                                            <span>Created At</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="created_at_sort"
                                                    value="{{ request('created_at_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('created_at_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('created_at_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('users.show', $user->id) }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('created_at') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                                <path
                                                    d="M14 14l-3.465-3.465M10.535 10.535A5 5 0 1 0 2 7a5 5 0 0 0 8.535 3.535Z"
                                                    stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <input type="text" name="created_at"
                                                class="bg-white/70 dark:bg-slate-950/30 p-2 pl-8 text-sm border rounded-xl border-white/20 dark:border-slate-800/60 w-full focus:ring-2 focus:ring-indigo-500/30 outline-none text-slate-900 dark:text-white placeholder:text-slate-400"
                                                value="{{ request('created_at') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('created_at'))
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except('created_at') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-slate-500 hover:text-red-600 transition">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M6 18 18 6M6 6l12 12" />
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-slate-700 dark:text-slate-200 flex items-center gap-2">
                                            <span>Status</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="status_sort"
                                                    value="{{ request('status_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        class="text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('status_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('status_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <form method="GET" action="{{ route('users.show', $user->id) }}">
                                            @foreach (request()->except('status') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="status" id="status" onchange="this.form.submit()"
                                                class="bg-white/70 dark:bg-slate-950/30 p-2 px-3 text-sm border rounded-xl border-white/20 dark:border-slate-800/60 w-full outline-none focus:ring-2 focus:ring-indigo-500/30 text-slate-900 dark:text-white">
                                                <option value=""
                                                    {{ request('status') === '' ? 'selected' : '' }}>All</option>
                                                <option value="married"
                                                    {{ request('status') === 'married' ? 'selected' : '' }}>Married
                                                </option>
                                                <option value="unmarried"
                                                    {{ request('status') === 'unmarried' ? 'selected' : '' }}>Unmarried
                                                </option>
                                                <option value="divorced"
                                                    {{ request('status') === 'divorced' ? 'selected' : '' }}>Divorced
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[13%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-slate-700 dark:text-slate-200 flex items-center gap-2">
                                            <span>Results</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.show', $user->id) }}">
                                                @foreach (request()->except(['husband_sort', 'results_sort', 'wife_sort', 'created_at_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="results_sort"
                                                    value="{{ request('results_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('results_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('results_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <form method="GET" action="{{ route('users.show', $user->id) }}">
                                            @foreach (request()->except('results') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="results" id="results" onchange="this.form.submit()"
                                                class="bg-white/70 dark:bg-slate-950/30 p-2 px-3 text-sm border rounded-xl border-white/20 dark:border-slate-800/60 w-full outline-none focus:ring-2 focus:ring-indigo-500/30 text-slate-900 dark:text-white">
                                                <option value=""
                                                    {{ request('results') === '' ? 'selected' : '' }}>All</option>
                                                <option value="0-50"
                                                    {{ request('results') === '0-50' ? 'selected' : '' }}>0% - 50%
                                                </option>
                                                <option value="51-80"
                                                    {{ request('results') === '51-80' ? 'selected' : '' }}>51% - 80%
                                                </option>
                                                <option value="81-100"
                                                    {{ request('results') === '81-100' ? 'selected' : '' }}>81% - 100%
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </th>
                            <th class="py-4 px-5 w-[7%]"></th>
                        </tr>
                    </thead>
                    <!-- Body -->
                    <tbody class="divide-y divide-white/20 bg-white/20 dark:divide-slate-800/60 dark:bg-slate-950/10">
                        @foreach ($couples as $couple)
                            <tr class="transition hover:bg-white/30 dark:hover:bg-white/5">
                                <td class="px-4 py-3 w-[5%]">
                                    <input type="checkbox" id="checkbox_{{ $couple->id }}"
                                        data-couple="{{ $couple->id }}" name="couples[]={{ $couple->id }}"
                                        class="h-5 w-5 rounded-lg border border-slate-300 bg-white text-indigo-600 focus:ring-2 focus:ring-indigo-500/30 dark:border-slate-700 dark:bg-slate-900" />
                                </td>
                                <td class="px-4 py-3 w-[18%]">
                                    <div>
                                        <span class="block font-bold">
                                            {{ $couple->husbandData ? $couple->husbandData->first_name . ' ' . $couple->husbandData->middle_name . ' ' . $couple->husbandData->last_name : 'N/A' }}
                                        </span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">Key: {{ $couple->husband_key }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[18%]">
                                    <div>
                                        <span class="block font-bold">
                                            {{ $couple->wifeData ? $couple->wifeData->first_name . ' ' . $couple->wifeData->middle_name . ' ' . $couple->wifeData->last_name : 'N/A' }}
                                        </span>
                                        <span class="text-xs text-slate-500 dark:text-slate-400">Key: {{ $couple->wife_key }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[13%] text-sm font-semibold text-slate-900 dark:text-white">
                                    {{ $couple->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    <span
                                        class="px-2 py-1 rounded text-xs {{ $couple->status === 'married' ? 'bg-green-100 text-green-800' : ($couple->status === 'divorced' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($couple->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    <div class="relative">
                                        <button onclick="toggleResultsDropdown(this)"
                                            class="px-3 py-2 bg-white/60 hover:bg-white/80 dark:bg-slate-950/40 dark:hover:bg-slate-950/60 rounded-xl border border-white/20 dark:border-slate-800/60 text-sm font-semibold text-slate-900 dark:text-white shadow-sm shadow-black/5">
                                            {{ $couple->result ? number_format($couple->result, 1) . '%' : 'N/A' }}
                                        </button>

                                        @if ($couple->results->count() > 0)
                                            <div
                                                class="hidden absolute right-0 mt-2 bg-white/85 border border-white/20 rounded-xl shadow-lg shadow-black/10 backdrop-blur-xl w-64 z-50 dark:bg-slate-950/70 dark:border-slate-800/60">
                                                <div class="p-3">
                                                    <h4 class="font-bold text-sm mb-2 border-b pb-2">Results by
                                                        Category</h4>
                                                    <ul class="space-y-2">
                                                        @foreach ($couple->results as $result)
                                                            <li class="flex justify-between items-center text-sm">
                                                                <span
                                                                    class="text-slate-700 dark:text-slate-200">{{ $result->category->category ?? 'Category' }}:</span>
                                                                <span
                                                                    class="font-semibold text-indigo-700 dark:text-indigo-200">{{ number_format($result->percent, 1) }}%</span>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[7%] relative">
                                    <div class="w-full flex justify-end">
                                        <button onclick="toggleDropdown(this)"
                                            class="inline-flex items-center justify-center rounded-xl p-2 text-slate-700 transition hover:bg-slate-900/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500/30 dark:text-slate-200 dark:hover:bg-white/5">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5 12h.01M12 12h.01M19 12h.01" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" />
                                            </svg>
                                        </button>

                                        <div
                                            class="hidden absolute right-0 mt-8 bg-white/85 border border-white/20 rounded-xl shadow-lg shadow-black/10 backdrop-blur-xl w-40 z-50 dark:bg-slate-950/70 dark:border-slate-800/60">
                                            <ul class="flex flex-col text-sm text-slate-700 dark:text-slate-200">
                                                <li>
                                                    <a href="{{ route('couples.show', $couple->id) }}"
                                                        class="block px-4 py-2 hover:bg-slate-900/5 dark:hover:bg-white/5">👁️ Ko‘rish</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('couples.edit', $couple->id) }}"
                                                        class="block px-4 py-2 hover:bg-slate-900/5 dark:hover:bg-white/5">✏️ Tahrirlash</a>
                                                </li>
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('couples.destroy', $couple->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this couple?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full text-left px-4 py-2 hover:bg-red-500/10 text-red-600 dark:text-red-400">
                                                            🗑️ O'chirish
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination -->
                <div
                    class="flex min-w-[1400px] justify-between items-center py-4 px-6 border-t border-white/20 dark:border-slate-800/60 bg-white/10 dark:bg-slate-950/10">
                    @if ($couples->onFirstPage())
                        <button disabled
                            class="rounded-xl bg-white/40 px-4 py-2 text-sm font-semibold text-slate-400 ring-1 ring-white/20 cursor-not-allowed dark:bg-slate-950/20 dark:ring-slate-800/60">
                            Previous
                        </button>
                    @else
                        <a href="{{ $couples->previousPageUrl() }}"
                            class="rounded-xl bg-white/60 px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm shadow-black/5 ring-1 ring-white/30 transition hover:bg-white/80 dark:bg-slate-950/40 dark:text-white dark:ring-slate-800/60 dark:hover:bg-slate-950/60">
                            Previous
                        </a>
                    @endif

                    <span
                        class="rounded-xl bg-white/60 px-6 py-2 text-sm font-semibold text-slate-900 shadow-sm shadow-black/5 ring-1 ring-white/30 dark:bg-slate-950/40 dark:text-white dark:ring-slate-800/60">
                        {{ $couples->appends(request()->all())->links() }}
                    </span>

                    @if ($couples->hasMorePages())
                        <a href="{{ $couples->nextPageUrl() }}"
                            class="rounded-xl bg-white/60 px-6 py-2 text-sm font-semibold text-slate-900 shadow-sm shadow-black/5 ring-1 ring-white/30 transition hover:bg-white/80 dark:bg-slate-950/40 dark:text-white dark:ring-slate-800/60 dark:hover:bg-slate-950/60">
                            Next
                        </a>
                    @else
                        <button disabled
                            class="rounded-xl bg-white/40 px-6 py-2 text-sm font-semibold text-slate-400 ring-1 ring-white/20 cursor-not-allowed dark:bg-slate-950/20 dark:ring-slate-800/60">
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </x-card>
@endsection

<script>
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        dropdown.classList.toggle('hidden');
        // tashqariga bosilganda yopish
        document.addEventListener('click', function(e) {
            if (!button.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    }
</script>

<script>
    document.getElementById('allCheckbox').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[type="checkbox"]:not(#allCheckbox)');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
        updateDeleteForm();
    });

    const bulkForm = document.getElementById('bulkDeleteForm');
    const selectedInputs = document.getElementById('selectedInputs');

    function updateDeleteForm() {
        const checked = document.querySelectorAll('input[type="checkbox"][data-couple]:checked');
        selectedInputs.innerHTML = '';

        checked.forEach(cb => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'couples[]';
            hidden.value = cb.dataset.couple;
            selectedInputs.appendChild(hidden);
        });

        bulkForm.classList.toggle('hidden', checked.length === 0);
    }

    document.addEventListener('change', function(e) {
        if (e.target.matches('input[type="checkbox"][data-couple]')) {
            updateDeleteForm();
        }
    });

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
