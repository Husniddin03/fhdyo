@extends('layouts.app')

@section('title', 'Create couple')
@section('nav', 'couple')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Create couple</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Assign husband & wife and set status.</p>
        </div>

        <x-button variant="soft" color="slate" :href="route('couples.index')">
            Back
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </x-button>
    </div>

    <x-card class="p-6 sm:p-8">
        <form action="{{ route('couples.store') }}" method="POST" class="space-y-6">
            @csrf
            @method('POST')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label for="husband" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Husband</label>
                    <select required name="husband" id="husband"
                        class="w-full rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:focus:bg-slate-950/60">
                        <option value="" {{ old('husband') == '' ? 'selected' : '' }}>Select human</option>
                        @foreach ($humans as $human)
                            @if ($human->gender == 'male')
                                <option value="{{ $human->id }}" {{ old('husband') == $human->id ? 'selected' : '' }}>
                                    {{ $human->first_name }} {{ $human->middle_name }} {{ $human->last_name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="wife" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Wife</label>
                    <select required name="wife" id="wife"
                        class="w-full rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:focus:bg-slate-950/60">
                        <option value="" {{ old('wife') == '' ? 'selected' : '' }}>Select human</option>
                        @foreach ($humans as $human)
                            @if ($human->gender == 'female')
                                <option value="{{ $human->id }}" {{ old('wife') == $human->id ? 'selected' : '' }}>
                                    {{ $human->first_name }} {{ $human->middle_name }} {{ $human->last_name }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <x-input name="count" type="number" label="Number" value="{{ old('count') }}" />

                <div>
                    <label for="status" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Status</label>
                    <select required name="status" id="status"
                        class="w-full rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:focus:bg-slate-950/60">
                        <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select status</option>
                        <option value="married" {{ old('status') == 'married' ? 'selected' : '' }}>Married</option>
                        <option value="unmarried" {{ old('status') == 'unmarried' ? 'selected' : '' }}>Unmarried</option>
                        <option value="divorced" {{ old('status') == 'divorced' ? 'selected' : '' }}>Divorced</option>
                    </select>
                </div>

                <div id="dateDiv">
                    <label for="date" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Date</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}"
                        class="w-full rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:focus:bg-slate-950/60" />
                </div>
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-white/20 pt-6 sm:flex-row sm:justify-end dark:border-slate-800/60">
                <x-button variant="soft" color="slate" type="button" onclick="window.location.href='{{ route('couples.index') }}'">
                    Cancel
                </x-button>
                <x-button type="submit" color="success">
                    Create
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="m4.5 12.75 4.5 4.5 10.5-10.5" stroke="currentColor" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </x-button>
            </div>
        </form>
    </x-card>

    <script>
        (function() {
            const status = document.getElementById('status');
            const dateDiv = document.getElementById('dateDiv');

            function sync() {
                if (!status || !dateDiv) return;
                dateDiv.classList.toggle('hidden', status.value === 'unmarried');
            }

            if (status) status.addEventListener('change', sync);
            sync();
        })();
    </script>
@endsection
