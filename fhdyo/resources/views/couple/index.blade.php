@extends('layouts.app')

@section('title', 'Couples')
@section('nav', 'couple')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Couples</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Browse, filter and manage couples.</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-3">
                <form id="bulkDeleteForm" method="POST" action="{{ route('couples.destroy', -1) }}"
                    onsubmit="return confirm('Are you sure you want to delete selected couples?');"
                    class="hidden rounded-xl bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 w-full sm:w-auto justify-center items-center gap-2">
                    @csrf
                    @method('DELETE')
                    <div id="selectedInputs"></div>
                    <button type="submit" class="text-white">Delete selected</button>
                </form>

                <a href="{{ route('couples.create') }}"
                    class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                    <h4 class="">Add couple</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>

                <a href="{{ route('couples.index') }}"
                    class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                    <h4 class="">Clear filter</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                    </svg>
                </a>

                <form method="GET"
                    class="inline-flex items-center justify-center gap-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl px-4 py-2.5 w-full sm:w-auto">
                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-200">Per page</h4>
                    @foreach (request()->except('per_page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <select name="per_page" onchange="this.form.submit()"
                        class="rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                        @for ($i = 10; $i <= $count; $i += 10)
                            <option value="{{ $i }}" {{ request()->get('per_page') == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                        <option {{ request()->get('per_page') == $count ? 'selected' : '' }} value="{{ $count }}">All
                        </option>
                    </select>
                </form>
            </div>
        </div>

        <div class="mt-6 rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
            <div class="overflow-x-auto rounded-xl overflow-hidden divide-y divide-gray-200 dark:divide-gray-700">
                <table class="w-full text-left min-w-[1400px] divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                        <tr>
                            <th class="py-4 px-5 w-[5%]">
                                <input type="checkbox" id="allCheckbox"
                                    class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500" />
                            </th>
                            <th class="py-4 px-5 w-[18%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Husband</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'user_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="husband_sort"
                                                    value="{{ request('husband_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
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
                                        <form method="GET" action="{{ route('couples.index') }}"
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
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search husband..."
                                                value="{{ request('husband') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('husband'))
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except('husband') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 transition">
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
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Wife</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'user_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="wife_sort"
                                                    value="{{ request('wife_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
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
                                        <form method="GET" action="{{ route('couples.index') }}"
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
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search wife..." value="{{ request('wife') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('wife'))
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except('wife') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 transition">
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
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Created At</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'user_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="created_at_sort"
                                                    value="{{ request('created_at_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
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
                                        <form method="GET" action="{{ route('couples.index') }}"
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
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                value="{{ request('created_at') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('created_at'))
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except('created_at') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 transition">
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
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>User</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'user_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="user_sort"
                                                    value="{{ request('user_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('user_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('user_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('couples.index') }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('user') as $key => $value)
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
                                            <input type="text" name="user"
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search user..." value="{{ request('user') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('user'))
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except('user') as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit"
                                                    class="p-2 text-gray-500 hover:text-red-600 transition">
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
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Status</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except(['husband_sort', 'wife_sort', 'created_at_sort', 'user_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="status_sort"
                                                    value="{{ request('status_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
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
                                        <form method="GET" action="{{ route('couples.index') }}">
                                            @foreach (request()->except('status') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="status" id="status" onchange="this.form.submit()"
                                                class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 px-3 text-sm">
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
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Results</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('couples.index') }}">
                                                @foreach (request()->except(['husband_sort', 'results_sort', 'wife_sort', 'created_at_sort', 'user_sort', 'status_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="results_sort"
                                                    value="{{ request('results_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
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
                                        <form method="GET" action="{{ route('couples.index') }}">
                                            @foreach (request()->except('results') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="results" id="results" onchange="this.form.submit()"
                                                class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 px-3 text-sm">
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
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($couples as $couple)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3 w-[5%]">
                                    <input type="checkbox" id="checkbox_{{ $couple->id }}"
                                        data-couple="{{ $couple->id }}" name="couples[]={{ $couple->id }}"
                                        class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500" />
                                </td>
                                <td class="px-4 py-3 w-[18%]">
                                    <div>
                                        <span class="block font-bold">
                                            {{ $couple->husbandData ? $couple->husbandData->first_name . ' ' . $couple->husbandData->middle_name . ' ' . $couple->husbandData->last_name : 'N/A' }}
                                        </span>
                                        <span class="text-xs text-gray-500">Key: {{ $couple->husband_key }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[18%]">
                                    <div>
                                        <span class="block font-bold">
                                            {{ $couple->wifeData ? $couple->wifeData->first_name . ' ' . $couple->wifeData->middle_name . ' ' . $couple->wifeData->last_name : 'N/A' }}
                                        </span>
                                        <span class="text-xs text-gray-500">Key: {{ $couple->wife_key }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    {{ $couple->created_at->format('Y-m-d H:i') }}
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    {{ $couple->user ? $couple->user->name : 'N/A' }}
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    <span
                                        class="px-2 py-1 rounded-xl text-xs {{ $couple->status === 'married' ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-200' : ($couple->status === 'divorced' ? 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/40 dark:text-yellow-200') }}">
                                        {{ ucfirst($couple->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 w-[13%]">
                                    <div class="relative">
                                        <button onclick="toggleResultsDropdown(this)"
                                            class="rounded-xl px-3 py-2 text-sm font-medium bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white transition">
                                            {{ $couple->result ? number_format($couple->result, 1) . '%' : 'N/A' }}
                                        </button>

                                        @if ($couple->results->count() > 0)
                                            <div
                                                class="hidden absolute right-0 mt-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg w-64 z-50 overflow-hidden">
                                                <div class="p-3">
                                                    <h4 class="font-bold text-sm mb-2 border-b border-gray-200 dark:border-gray-700 pb-2 text-gray-900 dark:text-white">Results by
                                                        Category</h4>
                                                    <ul class="space-y-2">
                                                        @foreach ($couple->results as $result)
                                                            <li class="flex justify-between items-center text-sm">
                                                                <span
                                                                    class="text-gray-700 dark:text-gray-200">{{ $result->category->category ?? 'Category' }}:</span>
                                                                <span
                                                                    class="font-semibold text-indigo-600 dark:text-indigo-300">{{ number_format($result->percent, 1) }}%</span>
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
                                            class="inline-flex items-center justify-center rounded-lg p-2 hover:bg-gray-100 dark:hover:bg-gray-600 transition text-gray-700 dark:text-gray-200">
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                        </button>

                                        <div
                                            class="hidden absolute right-0 mt-8 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl shadow-lg w-40 z-50 overflow-hidden">
                                            <ul class="flex flex-col text-sm text-gray-700 dark:text-gray-200">
                                                <li>
                                                    <a href="{{ route('couples.show', $couple->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">👁️ Ko‘rish</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('couples.edit', $couple->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">✏️ Tahrirlash</a>
                                                </li>
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('couples.destroy', $couple->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this couple?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600">
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
                <div class="flex min-w-[1400px] justify-between items-center py-4 px-5 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    @if ($couples->onFirstPage())
                        <button disabled
                            class="bg-gray-100 dark:bg-gray-700 text-gray-400 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl cursor-not-allowed">
                            Previous
                        </button>
                    @else
                        <a href="{{ $couples->previousPageUrl() }}"
                            class="bg-white dark:bg-gray-800 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Previous
                        </a>
                    @endif

                    <span class="bg-white dark:bg-gray-800 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl">
                        {{ $couples->appends(request()->all())->links() }}
                    </span>

                    @if ($couples->hasMorePages())
                        <a href="{{ $couples->nextPageUrl() }}"
                            class="bg-white dark:bg-gray-800 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Next
                        </a>
                    @else
                        <button disabled
                            class="bg-gray-100 dark:bg-gray-700 text-gray-400 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl cursor-not-allowed">
                            Next
                        </button>
                    @endif
                </div>
            </div>
    </div>
@endsection

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
