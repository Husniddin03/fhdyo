<!DOCTYPE html>
<html lang="en">

<head>
    <title>FHDYO</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-20 bg-white border-r border-gray-200">
            <div class="h-full flex flex-col items-center py-4">
                <!-- Logo -->
                <div class="p-2">
                    <img src="https://tailwindflex.com/images/logo.svg" alt="Logo" class="h-8 w-8">
                </div>

                <!-- Navigation -->
                <nav class="flex-1 w-full px-2 space-y-2 mt-6">
                    <a href="{{ route('home') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg {{ $title == 'home' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{ route('humans.index') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg {{ $title == 'human' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{ route('couples.index') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg {{ $title == 'couple' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1zM15 14a4 4 0 100-8 4 4 0 000 8zm6 6a6 6 0 00-12 0v1h12v-1z" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{ route('categories.index') }}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg {{ $title == 'category' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                            </svg>
                        </button>
                    </a>

                    <a href="{{route('graphic')}}">
                        <button
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg {{ $title == 'graphic' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50' }}">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </button>
                    </a>

                    {{-- admins --}}

                    @if (Auth::user()->role == 'super_admin')
                        <a href="{{ route('users.index') }}">
                            <button
                                class="w-full p-3 flex cursor-pointer justify-center rounded-lg {{ $title == 'admin' ? 'bg-indigo-50 text-indigo-600' : 'text-gray-500 hover:bg-gray-50' }}">
                                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </button>
                        </a>
                    @endif

                    {{-- logout --}}
                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to logout?');">
                        @csrf
                        <button type="submit"
                            class="w-full p-3 flex cursor-pointer justify-center rounded-lg text-red-500 hover:bg-gray-50">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </button>
                    </form>
                </nav>

                <!-- User Profile -->
                <div class="mt-auto pb-4">
                    <a href="{{ route('users.show', Auth::user()->id) }}">
                        <button class="w-12 cursor-pointer h-12 rounded-full overflow-hidden">
                            <img src="https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg?semt=ais_hybrid&w=740&q=80"
                                alt="User" class="w-full h-full object-cover">
                        </button>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 p-6 bg-gray-100 max-h-screen overflow-y-auto">
            {{ $slot }}
        </main>
    </div>

    <script>
        // Add active state to buttons
        const buttons = document.querySelectorAll('aside button');
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                buttons.forEach(btn => {
                    btn.classList.remove('bg-indigo-50', 'text-indigo-600');
                    btn.classList.add('text-gray-500');
                });
                button.classList.remove('text-gray-500');
                button.classList.add('bg-indigo-50', 'text-indigo-600');
            });
        });
    </script>
</body>

</html>
