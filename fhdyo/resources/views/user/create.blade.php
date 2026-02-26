@extends('layouts.app')

@section('title', 'Create admin')
@section('nav', 'admin')

@section('content')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-white">Create admin</h1>
            <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">Add a new admin user.</p>
        </div>

        <x-button variant="soft" color="slate" :href="route('users.index')">
            Back
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" stroke="currentColor" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </x-button>
    </div>

    <x-card class="p-6 sm:p-8">
        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf
            @method('POST')

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-input required name="name" label="Full name" value="{{ old('name') }}" />
                <x-input required name="email" label="Email" value="{{ old('email') }}" />
                <x-input required type="password" name="password" label="Password" />
                <x-input required type="password" name="password_confirmation" label="Password confirmation" />

                <div>
                    <label for="role" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Role</label>
                    <select required name="role" id="role"
                        class="w-full rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:focus:bg-slate-950/60">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super admin</option>
                    </select>
                </div>

                <div>
                    <label for="gender" class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Gender</label>
                    <select required name="gender" id="gender"
                        class="w-full rounded-2xl border border-white/30 bg-white/60 px-4 py-3 text-sm text-slate-900 shadow-sm shadow-black/5 outline-none transition focus:bg-white/80 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-800/60 dark:bg-slate-950/40 dark:text-white dark:focus:bg-slate-950/60">
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <x-input required type="date" name="birthday" label="Birthday" value="{{ old('birthday') }}" />
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-white/20 pt-6 sm:flex-row sm:justify-end dark:border-slate-800/60">
                <x-button variant="soft" color="slate" type="button" onclick="window.location.href='{{ route('users.index') }}'">
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
@endsection
