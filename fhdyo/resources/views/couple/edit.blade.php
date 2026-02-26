@extends('layouts.app')

@section('title', 'Edit couple')
@section('nav', 'couple')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Edit couple</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Update couple status and date.</p>
            </div>

            <a href="{{ route('couples.index') }}"
                class="inline-flex items-center justify-center gap-2 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-xl px-5 py-2.5 w-full sm:w-auto">
                <span>Back</span>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
        </div>

        <div class="mt-6 max-w-2xl mx-auto rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-6 sm:p-8">
            <form action="{{ route('couples.update', $couple->id) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <label for="husband" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Husband</label>
                        <select required name="husband" id="husband"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                            <option value="" {{ $couple->husbandData->id == '' ? 'selected' : '' }}>Select human</option>
                            @foreach ($humans as $human)
                                @if ($human->gender == 'male')
                                    <option value="{{ $human->id }}" {{ $couple->husbandData->id == $human->id ? 'selected' : '' }}>
                                        {{ $human->first_name }} {{ $human->middle_name }} {{ $human->last_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('husband')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="wife" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Wife</label>
                        <select required name="wife" id="wife"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                            <option value="" {{ $couple->wifeData->id == '' ? 'selected' : '' }}>Select human</option>
                            @foreach ($humans as $human)
                                @if ($human->gender == 'female')
                                    <option value="{{ $human->id }}" {{ $couple->wifeData->id == $human->id ? 'selected' : '' }}>
                                        {{ $human->first_name }} {{ $human->middle_name }} {{ $human->last_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('wife')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Status</label>
                        <select required name="status" id="status"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500">
                            <option value="" {{ $couple->status == '' ? 'selected' : '' }}>Select status</option>
                            <option value="married" {{ $couple->status == 'married' ? 'selected' : '' }}>Married</option>
                            <option value="unmarried" {{ $couple->status == 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                            <option value="divorced" {{ $couple->status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Date</label>
                        <input type="date" name="date" id="date" value="{{ $couple->date }}"
                            class="mt-2 w-full rounded-xl border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500" />
                        @error('date')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 sm:justify-end pt-2">
                    <a href="{{ route('couples.index') }}"
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
