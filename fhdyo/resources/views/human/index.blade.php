@extends('layouts.app')

@section('title', 'Humans')
@section('nav', 'human')

@section('content')

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Humans</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Browse, search and manage people records.</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-3">
                <form id="bulkDeleteForm" method="POST" action="{{ route('humans.destroy', -1) }}"
                    onsubmit="return confirm('Are you sure you want to delete selected humans?');"
                    class="hidden rounded-xl bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 w-full sm:w-auto justify-center items-center gap-2">
                    @csrf
                    @method('DELETE')
                    <div id="selectedInputs"></div>
                    <button type="submit" class="text-white">Delete selected</button>
                </form>

                <a href="{{ route('humans.create') }}"
                    class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                    <h4 class="">Add human</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>

                <a href="{{ route('humans.index') }}"
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
                <table class="w-full text-left min-w-[1200px] divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700 text-gray-600 dark:text-gray-200">
                        <tr>
                            <th class="py-4 px-5 w-[20%]">
                                <div class="flex items-center gap-4">
                                    <div class="w-[15%]">
                                        <input type="checkbox" id="allCheckbox"
                                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500" />
                                    </div>

                                    <div class="">
                                        <div class="flex items-center justify-between mb-2">
                                            <label class="font-medium text-gray-700 flex items-center gap-2">
                                                <span>Full name</span>
                                                {{-- Sort toggle --}}
                                                <form method="GET" action="{{ route('humans.index') }}">
                                                    @foreach (request()->except(['full_name_sort', 'gender_sort', 'birthday_sort', 'phone_sort', 'jshshir_sort', 'passport_id_sort', 'address_sort']) as $key => $value)
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}">
                                                    @endforeach
                                                    <button type="submit" name="full_name_sort"
                                                        value="{{ request('full_name_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            class="text-gray-600 hover:text-black transition">
                                                            <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                                fill="{{ request('full_name_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                            <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                                fill="{{ request('full_name_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            {{-- Search input --}}
                                            <form method="GET" action="{{ route('humans.index') }}"
                                                class="flex-1 relative">
                                                @foreach (request()->except('full_name') as $key => $value)
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
                                                <input type="text" name="full_name"
                                                    class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                    placeholder="Search full name..."
                                                    value="{{ request('full_name') ?? '' }}" />
                                            </form>

                                            {{-- Clear button --}}
                                            @if (request()->has('full_name'))
                                                <form method="GET" action="{{ route('humans.index') }}">
                                                    @foreach (request()->except('full_name') as $key => $value)
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}">
                                                    @endforeach
                                                    <button type="submit"
                                                        class="p-2 text-gray-500 hover:text-red-600 transition">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5"
                                                            stroke="currentColor" class="w-5 h-5">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="M6 18 18 6M6 6l12 12" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Gender</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except(['full_name_sort', 'gender_sort', 'birthday_sort', 'phone_sort', 'jshshir_sort', 'passport_id_sort', 'address_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="gender_sort"
                                                    value="{{ request('gender_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('gender_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('gender_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <form method="GET" action="{{ route('humans.index') }}">
                                            @foreach (request()->except('gender') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="gender" id="gender" onchange="this.form.submit()"
                                                class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 px-3 text-sm">
                                                <option value=""
                                                    {{ request('gender') === '' ? 'selected' : '' }}>All</option>
                                                <option value="male"
                                                    {{ request('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female"
                                                    {{ request('gender') === 'female' ? 'selected' : '' }}>Female
                                                </option>
                                            </select>
                                        </form>
                                    </div>
                                </div>

                            </th>
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Birthday</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except(['full_name_sort', 'gender_sort', 'birthday_sort', 'phone_sort', 'jshshir_sort', 'passport_id_sort', 'address_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="birthday_sort"
                                                    value="{{ request('birthday_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('birthday_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('birthday_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('humans.index') }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('birthday') as $key => $value)
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
                                            <input type="text" name="birthday"
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search birthday..."
                                                value="{{ request('birthday') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('birthday'))
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except('birthday') as $key => $value)
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
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Phone</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except(['full_name_sort', 'gender_sort', 'birthday_sort', 'phone_sort', 'jshshir_sort', 'passport_id_sort', 'address_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="phone_sort"
                                                    value="{{ request('phone_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('phone_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('phone_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('humans.index') }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('phone') as $key => $value)
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
                                            <input type="text" name="phone"
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search phone..." value="{{ request('phone') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('phone'))
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except('phone') as $key => $value)
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
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Jshshir</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except(['full_name_sort', 'gender_sort', 'birthday_sort', 'phone_sort', 'jshshir_sort', 'passport_id_sort', 'address_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="jshshir_sort"
                                                    value="{{ request('jshshir_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('jshshir_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('jshshir_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('humans.index') }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('jshshir') as $key => $value)
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
                                            <input type="text" name="jshshir"
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search jshshir..."
                                                value="{{ request('jshshir') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('jshshir'))
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except('jshshir') as $key => $value)
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
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Passport ID</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except(['full_name_sort', 'gender_sort', 'birthday_sort', 'phone_sort', 'jshshir_sort', 'passport_id_sort', 'address_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="passport_id_sort"
                                                    value="{{ request('passport_id_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('passport_id_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('passport_id_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('humans.index') }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('passport_id') as $key => $value)
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
                                            <input type="text" name="passport_id"
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search passport ID..."
                                                value="{{ request('passport_id') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('passport_id'))
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except('passport_id') as $key => $value)
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
                            <th class="py-4 px-5 w-[12%]">
                                <div class="flex flex-col gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="font-medium text-gray-700 flex items-center gap-2">
                                            <span>Address</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except(['full_name_sort', 'gender_sort', 'birthday_sort', 'phone_sort', 'jshshir_sort', 'passport_id_sort', 'address_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="address_sort"
                                                    value="{{ request('address_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('address_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('address_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('humans.index') }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('address') as $key => $value)
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
                                            <input type="text" name="address"
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search address..."
                                                value="{{ request('address') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('address'))
                                            <form method="GET" action="{{ route('humans.index') }}">
                                                @foreach (request()->except('address') as $key => $value)
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
                            <th class="py-4 px-5 w-[7%]"></th>
                        </tr>
                    </thead>
                    <!-- Body -->
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($humans as $human)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3 w-[20%]">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" id="checkbox_{{ $human->id }}"
                                            data-human="{{ $human->id }}" name="humans[]={{ $human->id }}"
                                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500" />
                                        <div>
                                            <span
                                                class="block font-semibold text-gray-900 dark:text-white">{{ $human->first_name . ' ' . $human->last_name . ' ' . $human->middle_name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[12%]">
                                    <div>
                                        <span>{{ $human->gender }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[12%]">{{ $human->birthday }}</td>
                                <td class="px-4 py-3 w-[12%]">{{ $human->phone }}</td>
                                <td class="px-4 py-3 w-[13%]">
                                    <div class="flex flex-col">
                                        <span>{{ $human->jshshir }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[12%] text-xs">{{ $human->passport_id }}</td>
                                <td class="px-4 py-3 w-[12%] text-xs">{{ $human->province . ', ' . $human->region }}
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
                                                    <a href="{{ route('humans.show', $human->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">👁️ Ko‘rish</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('humans.edit', $human->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">✏️ Tahrirlash</a>
                                                </li>
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('humans.destroy', $human->id) }}" onsubmit="return confirm('Are you sure you want to delete selected humans?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-600">
                                                            🗑️ O‘chirish
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
                <div class="flex min-w-[1200px] justify-between items-center py-4 px-5 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    @if ($humans->onFirstPage())
                        <button disabled
                            class="bg-gray-100 dark:bg-gray-700 text-gray-400 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl cursor-not-allowed">
                            Previous
                        </button>
                    @else
                        <a href="{{ $humans->previousPageUrl() }}"
                            class="bg-white dark:bg-gray-800 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Previous
                        </a>
                    @endif

                    <span
                        class="bg-white dark:bg-gray-800 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl">
                        {{ $humans->appends(request()->all())->links() }}
                    </span>

                    @if ($humans->hasMorePages())
                        <a href="{{ $humans->nextPageUrl() }}"
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
    });
</script>

<script>
    const bulkForm = document.getElementById('bulkDeleteForm');
    const selectedInputs = document.getElementById('selectedInputs');
    const allCheckbox = document.getElementById('allCheckbox');

    function updateDeleteForm() {
        // Tanlanganlarni yig‘ish
        const checked = document.querySelectorAll('input[type="checkbox"][data-human]:checked');
        selectedInputs.innerHTML = ''; // eski hidden inputlarni tozalash

        checked.forEach(cb => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'humans[]';
            hidden.value = cb.dataset.human;
            selectedInputs.appendChild(hidden);
        });

        // Agar birortasi tanlangan bo‘lsa form ko‘rinadi
        bulkForm.classList.toggle('hidden', checked.length === 0);
    }

    // "Select all" checkbox
    if (allCheckbox) {
        allCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][data-human]');
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateDeleteForm();
        });
    }

    // Har bir checkbox uchun listener
    document.addEventListener('change', function(e) {
        if (e.target.matches('input[type="checkbox"][data-human]')) {
            updateDeleteForm();
        }
    });
</script>

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
