@extends('layouts.app')

@section('title', 'Update Human')
@section('nav', 'human')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Update Human</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Edit personal information and identity fields.</p>
            </div>

            <a href="{{ route('humans.index') }}"
                class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                <span>Back</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
        </div>

        <div
            class="mt-6 max-w-2xl mx-auto rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 sm:p-8">
            <form action="{{ route('humans.update', $human->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">First Name</label>
                        <input required type="text" name="first_name" id="first_name" value="{{ $human->first_name }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('first_name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Last Name</label>
                        <input required type="text" name="last_name" id="last_name" value="{{ $human->last_name }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('last_name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="middle_name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Middle Name</label>
                        <input required type="text" name="middle_name" id="middle_name" value="{{ $human->middle_name }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('middle_name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Gender</label>
                        <select required name="gender" id="gender"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                            <option value="male" {{ $human->gender == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ $human->gender == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                        @error('gender')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="birthday" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Birthday</label>
                        <input required type="date" name="birthday" id="birthday" value="{{ $human->birthday }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('birthday')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Phone</label>
                        <input required type="text" name="phone" id="phone" value="{{ $human->phone }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('phone')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="jshshir" class="block text-sm font-medium text-gray-700 dark:text-gray-200">JSHSHIR</label>
                        <input required type="text" name="jshshir" id="jshshir" value="{{ $human->jshshir }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('jshshir')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="passport_id" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Passport ID</label>
                        <input required type="text" name="passport_id" id="passport_id" value="{{ $human->passport_id }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('passport_id')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Province</label>
                        <input required type="text" name="province" id="province" value="{{ $human->province }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('province')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="region" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Region</label>
                        <input required type="text" name="region" id="region" value="{{ $human->region }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('region')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:justify-end pt-2">
                    <a href="{{ route('humans.index') }}"
                        class="inline-flex items-center justify-center bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                        Cancel
                    </a>
                    <button type="submit"
                        class="inline-flex items-center justify-center bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
