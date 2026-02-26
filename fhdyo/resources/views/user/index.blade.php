@extends('layouts.app')

@section('title', 'Admins')
@section('nav', 'admin')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Admins</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage admin accounts and permissions.</p>
            </div>

            <div class="flex flex-col sm:flex-row sm:flex-wrap items-stretch sm:items-center gap-3">
                <form id="bulkDeleteForm" method="POST" action="{{ route('users.destroy', -1) }}"
                    onsubmit="return confirm('Are you sure you want to delete selected users?');"
                    class="hidden rounded-xl bg-red-600 hover:bg-red-700 text-white px-5 py-2.5 w-full sm:w-auto justify-center items-center gap-2">
                    @csrf
                    @method('DELETE')
                    <div id="selectedInputs"></div>
                    <button type="submit" class="text-white">Delete selected</button>
                </form>

                <a href="{{ route('users.create') }}"
                    class="inline-flex items-center justify-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                    <h4 class="">Add admin</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>

                <a href="{{ route('users.index') }}"
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

        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
            <div class="rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 grid place-items-center text-indigo-600 dark:text-indigo-300">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 19.128c.851.196 1.67.476 2.448.835A8.967 8.967 0 0 0 21 12.75C21 7.78 16.97 3.75 12 3.75S3 7.78 3 12.75c0 3.146 1.618 5.914 4.065 7.5.777-.36 1.596-.64 2.448-.835" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 12.75a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $users->total() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total admins</div>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 grid place-items-center text-emerald-600 dark:text-emerald-300">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M3 12h18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                            <path d="M12 3v18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">{{ request()->get('per_page') ?? 10 }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Per page</div>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-amber-50 dark:bg-amber-900/30 grid place-items-center text-amber-600 dark:text-amber-300">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 8v4l3 3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke="currentColor" stroke-width="1.5" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $users->currentPage() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Current page</div>
                    </div>
                </div>
            </div>
            <div class="rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-5">
                <div class="flex items-center gap-4">
                    <div class="h-12 w-12 rounded-xl bg-slate-100 dark:bg-gray-700 grid place-items-center text-slate-600 dark:text-gray-200">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 7h10M7 12h10M7 17h10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-2xl font-semibold text-gray-900 dark:text-white">{{ $users->lastPage() }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">Total pages</div>
                    </div>
                </div>
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
                                                <form method="GET" action="{{ route('users.index') }}">
                                                    @foreach (request()->except(['name_sort', 'gender_sort', 'birthday_sort', 'email_sort', 'role_sort']) as $key => $value)
                                                        <input type="hidden" name="{{ $key }}"
                                                            value="{{ $value }}">
                                                    @endforeach
                                                    <button type="submit" name="name_sort"
                                                        value="{{ request('name_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                        <svg width="20" height="20" viewBox="0 0 20 20"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg"
                                                            class="text-gray-600 hover:text-black transition">
                                                            <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                                fill="{{ request('name_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                            <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                                fill="{{ request('name_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </label>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            {{-- Search input --}}
                                            <form method="GET" action="{{ route('users.index') }}"
                                                class="flex-1 relative">
                                                @foreach (request()->except('name') as $key => $value)
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
                                                <input type="text" name="name"
                                                    class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                    placeholder="Search full name..."
                                                    value="{{ request('name') ?? '' }}" />
                                            </form>

                                            {{-- Clear button --}}
                                            @if (request()->has('name'))
                                                <form method="GET" action="{{ route('users.index') }}">
                                                    @foreach (request()->except('name') as $key => $value)
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
                                            <span>Email</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.index') }}">
                                                @foreach (request()->except(['name_sort', 'gender_sort', 'birthday_sort', 'email_sort', 'role_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="email_sort"
                                                    value="{{ request('email_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('email_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('email_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        {{-- Search input --}}
                                        <form method="GET" action="{{ route('users.index') }}"
                                            class="flex-1 relative">
                                            @foreach (request()->except('email') as $key => $value)
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
                                            <input type="text" name="email"
                                                class="w-full md:w-64 rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 pl-8 text-sm"
                                                placeholder="Search email..." value="{{ request('email') ?? '' }}" />
                                        </form>

                                        {{-- Clear button --}}
                                        @if (request()->has('email'))
                                            <form method="GET" action="{{ route('users.index') }}">
                                                @foreach (request()->except('email') as $key => $value)
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
                                            <span>Role</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.index') }}">
                                                @foreach (request()->except(['name_sort', 'gender_sort', 'birthday_sort', 'email_sort', 'role_sort']) as $key => $value)
                                                    <input type="hidden" name="{{ $key }}"
                                                        value="{{ $value }}">
                                                @endforeach
                                                <button type="submit" name="role_sort"
                                                    value="{{ request('role_sort') === 'asc' ? 'desc' : 'asc' }}">
                                                    <svg width="20" height="20" viewBox="0 0 20 20"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg"
                                                        class="text-gray-600 hover:text-black transition">
                                                        <path d="M15 9.167L10 4.167 5 9.167h10Z"
                                                            fill="{{ request('role_sort') === 'asc' ? 'black' : '#9CA3AF' }}" />
                                                        <path d="M15 10.833 10 15.833 5 10.833h10Z"
                                                            fill="{{ request('role_sort') === 'desc' ? 'black' : '#9CA3AF' }}" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </label>
                                    </div>

                                    <div class="relative">
                                        <form method="GET" action="{{ route('users.index') }}">
                                            @foreach (request()->except('role') as $key => $value)
                                                <input type="hidden" name="{{ $key }}"
                                                    value="{{ $value }}">
                                            @endforeach
                                            <select name="role" id="role" onchange="this.form.submit()"
                                                class="w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 bg-white p-2 px-3 text-sm">
                                                <option value=""
                                                    {{ request('role') === '' ? 'selected' : '' }}>All</option>
                                                <option value="admin"
                                                    {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                                                <option value="super_admin"
                                                    {{ request('role') === 'super_admin' ? 'selected' : '' }}>Super admin
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
                                            <span>Gender</span>
                                            {{-- Sort toggle --}}
                                            <form method="GET" action="{{ route('users.index') }}">
                                                @foreach (request()->except(['name_sort', 'gender_sort', 'birthday_sort', 'email_sort', 'role_sort']) as $key => $value)
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
                                        <form method="GET" action="{{ route('users.index') }}">
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
                                            <form method="GET" action="{{ route('users.index') }}">
                                                @foreach (request()->except(['name_sort', 'gender_sort', 'birthday_sort', 'email_sort', 'role_sort']) as $key => $value)
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
                                        <form method="GET" action="{{ route('users.index') }}"
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
                                            <form method="GET" action="{{ route('users.index') }}">
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
                            
                            
                            <th class="py-4 px-5 w-[7%]"></th>
                        </tr>
                    </thead>
                    <!-- Body -->
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <td class="px-4 py-3 w-[20%]">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" id="checkbox_{{ $user->id }}"
                                            data-user="{{ $user->id }}" name="users[]={{ $user->id }}"
                                            class="w-5 h-5 rounded border-gray-300 dark:border-gray-600 text-indigo-600 focus:ring-indigo-500" />
                                        <div>
                                            <span
                                                class="block font-semibold text-gray-900 dark:text-white">{{ $user->name }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[12%]">
                                    <div>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 w-[12%]">{{ $user->role }}</td>
                                <td class="px-4 py-3 w-[12%]">{{ $user->userData->gender ?? '-' }}</td>
                                <td class="px-4 py-3 w-[12%]">{{ $user->userData->birthday ?? '-'}}</td>
                                
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
                                                    <a href="{{ route('users.show', $user->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">👁️ Ko‘rish</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('users.edit', $user->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">✏️ Tahrirlash</a>
                                                </li>
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('users.destroy', $user->id) }}" onsubmit="return confirm('Are you sure you want to delete selected users?');">
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
                    @if ($users->onFirstPage())
                        <button disabled
                            class="bg-gray-100 dark:bg-gray-700 text-gray-400 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl cursor-not-allowed">
                            Previous
                        </button>
                    @else
                        <a href="{{ $users->previousPageUrl() }}"
                            class="bg-white dark:bg-gray-800 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                            Previous
                        </a>
                    @endif

                    <span class="bg-white dark:bg-gray-800 font-semibold border border-gray-200 dark:border-gray-700 px-4 py-2 rounded-xl">
                        {{ $users->appends(request()->all())->links() }}
                    </span>

                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}"
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
        const checked = document.querySelectorAll('input[type="checkbox"][data-user]:checked');
        selectedInputs.innerHTML = ''; // eski hidden inputlarni tozalash

        checked.forEach(cb => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'users[]';
            hidden.value = cb.dataset.user;
            selectedInputs.appendChild(hidden);
        });

        // Agar birortasi tanlangan bo‘lsa form ko‘rinadi
        bulkForm.classList.toggle('hidden', checked.length === 0);
    }

    // "Select all" checkbox
    if (allCheckbox) {
        allCheckbox.addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][data-user]');
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateDeleteForm();
        });
    }

    // Har bir checkbox uchun listener
    document.addEventListener('change', function(e) {
        if (e.target.matches('input[type="checkbox"][data-user]')) {
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
