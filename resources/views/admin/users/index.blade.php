<x-admin.main page="admin.users.index" title="Barcha foydalanuvchilar">

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
            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ismi</th>
                                <th>Jshshir</th>
                                <th>Paspot ID</th>
                                <th>Telefon</th>
                                <th>Viloyat</th>
                                <th>Tuman</th>
                                <th>Sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <span class="badge badge-soft badge-success text-xs">Professional</span>
                                <span class="badge badge-soft badge-error text-xs">Rejected</span>
                                <span class="badge badge-soft badge-info text-xs">Applied</span> --}}
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->data->jshshir }}</td>
                                    <td>{{ $user->data->passport_id }}</td>
                                    <td>{{ $user->data->phone }}</td>
                                    <td>{{ $user->data->province }}</td>
                                    <td>{{ $user->data->region }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($user->update_at)->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        <a href="{{route('admin.users.show', $user->id)}}">
                                            <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="size-5"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                        </a>

                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                                class="icon-[tabler--pencil] size-5"></span></button>
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                                class="icon-[tabler--trash] size-5"></span></button>
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
