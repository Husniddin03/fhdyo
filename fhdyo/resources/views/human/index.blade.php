<x-app title="human">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Humans</h1>

        <div class="flex justify-center items-center gap-2">
            <form id="bulkDeleteForm" method="POST" action="{{ route('humans.destroy', -1) }}"
                onsubmit="return confirm('Are you sure you want to delete selected humans?');"
                class="hidden bg-red-500 mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                @csrf
                @method('DELETE')
                <div id="selectedInputs"></div>
                <button type="submit" class="text-white">
                    Delete selected
                </button>
            </form>


            <a href="{{ route('humans.index') }}"
                class="mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                <h4 class="">Clear filter</h4>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5" />
                </svg>
            </a>
            <form method="GET"
                class="mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                <h4>Per page</h4>
                @foreach (request()->except('per_page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <select name="per_page" onchange="this.form.submit()">
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
    <div class="mt-4 bg-white rounded-lg shadow-md">
        <div class="mt-4 p-6 bg-white rounded-lg shadow-md flex justify-center space-x-4 contents-center">

            <div class="w-full border items-center border-gray-400 rounded-lg overflow-x-auto">
                <!-- Table -->
                <table class="w-full text-left min-w-[1200px]">
                    <!-- Head -->
                    <thead class="font-bold">
                        <tr>
                            <th class="py-4 px-5 w-[20%]">
                                <div class="flex items-center gap-4">
                                    <div class="w-[15%]">
                                        <input type="checkbox" id="allCheckbox" class="w-5 h-5 rounded-lg " />
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
                                                    class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
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
                                                class="bg-white p-2 px-3 text-sm focus:outline-none border rounded-md border-gray-300 w-full">
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
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
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
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
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
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
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
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
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
                                                class="bg-white p-2 pl-8 text-sm border rounded-md border-gray-300 w-full focus:ring focus:ring-blue-200"
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
                    <tbody class="bg-gray-100">
                        @foreach ($humans as $human)
                            <tr class="border-t border-gray-400">
                                <td class="px-4 py-3 w-[20%]">
                                    <div class="flex items-center space-x-2">
                                        <input type="checkbox" id="checkbox_{{ $human->id }}" data-human="{{ $human->id }}"
                                            name="humans[]={{ $human->id }}" class="w-5 h-5 rounded-lg" />
                                        <div>
                                            <span
                                                class="block font-bold">{{ $human->first_name . ' ' . $human->last_name . ' ' . $human->middle_name }}</span>
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
                                <td class="px-4 py-3 w-[7%] relative" x-data="{ open: false }">
                                    <div class="w-full flex justify-end">
                                        <!-- Trigger button -->
                                        <button @click="open = !open"
                                            class="flex flex-col gap-y-1 mr-6 text-black hover:text-gray-600 px-5 py-2 hover:bg-gray-400 hover:rounded-xl focus:outline-none">
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                            <span class="bg-black h-1 w-1 rounded-full"></span>
                                        </button>

                                        <!-- Dropdown -->
                                        <div x-show="open" @click.away="open = false"
                                            x-transition:enter="transition ease-out duration-200"
                                            x-transition:enter-start="opacity-0 transform scale-95"
                                            x-transition:enter-end="opacity-100 transform scale-100"
                                            x-transition:leave="transition ease-in duration-150"
                                            x-transition:leave-start="opacity-100 transform scale-100"
                                            x-transition:leave-end="opacity-0 transform scale-95"
                                            class="absolute right-0 mt-8 bg-white border rounded-md shadow-lg w-36 z-50">
                                            <ul class="flex flex-col text-sm text-gray-700">
                                                <li>
                                                    <a href="{{ route('humans.edit', $human->id) }}"
                                                        class="block px-4 py-2 hover:bg-gray-100">✏️ Tahrirlash</a>
                                                </li>
                                                <li>
                                                    <form method="POST"
                                                        action="{{ route('humans.destroy', $human->id) }}"
                                                        onsubmit="return confirm('Are you sure you want to delete this human?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="w-full text-left px-4 py-2 hover:bg-gray-100 text-red-600">
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
                <div class="flex min-w-[1200px] justify-between items-center py-4 px-5 border-t border-gray-400">
                    @if ($humans->onFirstPage())
                        <button disabled
                            class="bg-gray-100 text-gray-400 font-bold border border-gray-300 px-4 py-2 rounded-md cursor-not-allowed">
                            Previous
                        </button>
                    @else
                        <a href="{{ $humans->previousPageUrl() }}"
                            class="bg-white font-bold border border-gray-400 px-4 py-2 rounded-md hover:border-gray-600 hover:bg-gray-50 transition-colors">
                            Previous
                        </a>
                    @endif

                    <span
                        class="bg-white font-bold border border-gray-400 px-6 py-2 rounded-md hover:border-gray-600 hover:bg-gray-50 transition-colors">
                        {{ $humans->appends(request()->all())->links() }}
                    </span>

                    @if ($humans->hasMorePages())
                        <a href="{{ $humans->nextPageUrl() }}"
                            class="bg-white font-bold border border-gray-400 px-6 py-2 rounded-md hover:border-gray-600 hover:bg-gray-50 transition-colors">
                            Next
                        </a>
                    @else
                        <button disabled
                            class="bg-gray-100 text-gray-400 font-bold border border-gray-300 px-6 py-2 rounded-md cursor-not-allowed">
                            Next
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app>


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
