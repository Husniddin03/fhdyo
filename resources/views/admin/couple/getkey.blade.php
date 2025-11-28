<x-admin.main page="admin.couple.getkey" title="Juftiklar uchun kalit">

    <!-- Layout Container -->
    <div class="lg:ps-75 flex grow flex-col">

        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
            <div class="mx-auto w-full max-w-7xl">

                <nav class="navbar py-2">
                    <div class="navbar-start items-center gap-3">

                        <div class="input no-focus border-0 px-0 flex items-center gap-3 shadow-md rounded-xl p-4">

                            <h3 id="keyText" class="text-center font-mono text-lg tracking-wide select-all">
                                {{ $key }}
                            </h3>

                            <button onclick="copyKey('keyText', 'copyMsg')"
                                class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                </svg>

                            </button>

                        </div>
                    </div>
                </nav>

                <p id="copyMsg" class="text-green-600 mt-3 hidden">Kalit nusxalandi!</p>

            </div>
        </main>
        <!-- / Content -->
    </div>
</x-admin.main>
