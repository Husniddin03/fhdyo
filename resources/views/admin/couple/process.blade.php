<x-admin.main page="admin.couple.process" title="Yakunlanmagan testlar juftiklar">

    <!-- Layout Container -->
    <div class="lg:ps-75 flex grow flex-col">

        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">

            <div class="mx-auto w-full max-w-7xl">
                <nav class="navbar py-2">
                    <div class="navbar-start items-center gap-2">
                        <button type="button" class="btn btn-soft btn-square btn-sm lg:hidden" aria-haspopup="dialog"
                            aria-expanded="false" aria-controls="layout-sidebar" data-overlay="#layout-sidebar">
                            <span class="icon-[tabler--menu-2] size-4.5"></span>
                        </button>

                        <!-- Search  -->
                        <div class="input no-focus border-0 px-0">
                            <span
                                class="icon-[tabler--search] text-base-content/80 my-auto me-2 size-4 shrink-0"></span>
                            <input type="search" class="grow placeholder:text-sm" placeholder="Type to Search..."
                                id="kbdInput" />
                            <label class="sr-only" for="kbdInput">Search</label>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="mx-auto w-full max-w-7xl hidden" style="background-color: greenyellow !important"
                id="copy_text">
                <nav class="navbar py-2" style="background-color: turquoise !important; color: black;">
                    <div class="navbar-start items-center gap-2">
                        <h3>Nushalandi</h3>
                    </div>
                </nav>
            </div>
            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Birinchi ishtirikchi</th>
                                <th>Ikkinchi ishtirikchi</th>
                                <th>Turkum</th>
                                <th>Kali</th>
                                <th>Sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <span class="badge badge-soft badge-success text-xs">Professional</span>
                                <span class="badge badge-soft badge-error text-xs">Rejected</span>
                                <span class="badge badge-soft badge-info text-xs">Applied</span> --}}
                            @foreach ($couples as $couple)
                                <tr>
                                    @if ($couple->firstUser->gender == 'Erkak')
                                        @if (count($couple->firstUser->answers) > 0)
                                            <td>
                                                <a href="{{ route('admin.users.show', $couple->firstUser->id) }}">{{ $couple->firstUser->name }}
                                                    <span
                                                        class="badge badge-soft badge-success text-xs">Tugallangan</span></a>
                                            </td>
                                        @else
                                            <td> <a href="{{ route('admin.users.show', $couple->firstUser->id) }}">{{ $couple->firstUser->name }}
                                                    <span
                                                        class="badge badge-soft badge-error text-xs">Tugallanmagan</span></a>
                                            </td>
                                        @endif

                                        @if (count($couple->secondUser->answers) > 0)
                                            <td>
                                                <a href="{{ route('admin.users.show', $couple->secondUser->id) }}">
                                                    {{ $couple->secondUser->name }} <span
                                                        class="badge badge-soft badge-success text-xs">Tugallangan</span></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.users.show', $couple->secondUser->id) }}">
                                                    {{ $couple->secondUser->name }}<span
                                                        class="badge badge-soft badge-error text-xs">Tugallanmagan</span></a>
                                            </td>
                                        @endif
                                    @else
                                        @if (count($couple->secondUser->answers) > 0)
                                            <td>
                                                <a href="{{ route('admin.users.show', $couple->secondUser->id) }}">
                                                    {{ $couple->secondUser->name }} <span
                                                        class="badge badge-soft badge-success text-xs">Tugallangan</span></a>
                                            </td>
                                        @else
                                            <td>
                                                <a href="{{ route('admin.users.show', $couple->secondUser->id) }}">
                                                    {{ $couple->secondUser->name }}<span
                                                        class="badge badge-soft badge-error text-xs">Tugallanmagan</span></a>
                                            </td>
                                        @endif
                                        @if (count($couple->firstUser->answers) > 0)
                                            <td>
                                                <a href="{{ route('admin.users.show', $couple->firstUser->id) }}">{{ $couple->firstUser->name }}
                                                    <span
                                                        class="badge badge-soft badge-success text-xs">Tugallangan</span></a>
                                            </td>
                                        @else
                                            <td> <a href="{{ route('admin.users.show', $couple->firstUser->id) }}">{{ $couple->firstUser->name }}
                                                    <span
                                                        class="badge badge-soft badge-error text-xs">Tugallanmagan</span></a>
                                            </td>
                                        @endif
                                    @endif

                                    <td>
                                        @foreach (explode(',', $couple->questions_type) as $type)
                                            <span class="badge badge-soft badge-success text-xs me-1">
                                                {{ trim($type) }}
                                            </span>
                                        @endforeach
                                    </td>

                                    @php
                                        if ($couple->result >= 75) {
                                            $result = 'success';
                                        } elseif ($couple->result >= 50) {
                                            $result = 'info';
                                        } else {
                                            $result = 'error';
                                        }
                                    @endphp
                                    <td class="dt-type-numeric">
                                        <div
                                            class="input no-focus border-0 px-0 flex items-center gap-3 shadow-md rounded-xl p-4">

                                            <p id="keyText_{{ $couple->id }}" class="hidden">{{ $couple->key }}</p>
                                            <h3 class="text-center font-mono text-lg tracking-wide select-all">
                                                {{ substr($couple->key, 0, 6) }}....
                                            </h3>

                                            <button onclick="copyKey('keyText_{{ $couple->id }}', 'copy_text')"
                                                class="px-3 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                                                </svg>

                                            </button>

                                        </div>
                                    </td>
                                    <td>
                                        {{ \Carbon\Carbon::parse($couple->update_at)->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.couple.destroy', $couple->id) }}" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Foydalanuvchi ma\'lumoti o\'chiriladi. Davom etasizmi?')">
                                            @csrf
                                            <input type="hidden" name="_method" id="" value="DELETE">
                                            <button type="submit" class="btn btn-circle btn-text btn-sm"
                                                aria-label="Action button"><span
                                                    class="icon-[tabler--trash] size-5"></span></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- / Content -->
    </div>
</x-admin.main>
