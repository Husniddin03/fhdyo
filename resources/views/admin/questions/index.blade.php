<x-admin.main page="admin.questions.index" title="Barcha testlar">

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
                                <th>Tifalar</th>
                                <th>Savollar soni</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <span class="badge badge-soft badge-success text-xs">Professional</span>
                                <span class="badge badge-soft badge-error text-xs">Rejected</span>
                                <span class="badge badge-soft badge-info text-xs">Applied</span> --}}
                            <tr class="{{ $create == 'true' ? '' : 'hidden' }}">
                                <form action="{{ route('admin.questions.create') }}" method="GET">
                                    <td class="p-0">
                                        <input type="text" name="type" placeholder="Tifaga nom bering ..."
                                            class="block w-full h-full px-4 py-2" required>
                                    </td>
                                    <td class="p-0">
                                        <input type="number" name="count" placeholder="Toifadagi savollar soni ..."
                                            class="block w-full h-full px-4 py-2" required>
                                    </td>

                                    <td>
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                            </svg>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            <tr class="{{ $update != null ? '' : 'hidden' }}">
                                <form action="{{ route('admin.questions.update', $questions[0]->type) }}"
                                    method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="_method" value="PUT" id="">
                                    <td class="p-0">
                                        <input type="text" name="type" placeholder="Tifaga nom bering ..."
                                            value="{{ $update }}" class="block w-full h-full px-4 py-2" required>
                                    </td>
                                    <td></td>
                                    <td>
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                            </svg>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            @foreach ($questions as $question)
                                <tr>
                                    <td><a
                                            href="{{ route('admin.questions.show', $question->type) }}">{{ $question->type }}</a>
                                    </td>
                                    <td>{{ $question->count }} ta</td>

                                    <td>
                                        <a href="{{ route('admin.questions.index', 'create=true') }}">
                                            <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </button>
                                        </a>
                                        <a href="{{ route('admin.questions.show', $question->type) }}">
                                            <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" class="size-5" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                            </button>
                                        </a>

                                        <a href="{{ route('admin.questions.index', 'update=' . $question->type) }}">
                                            <button class="btn btn-circle btn-text btn-sm"
                                                aria-label="Action button"><span
                                                    class="icon-[tabler--pencil] size-5"></span></button>
                                        </a>
                                        <form action="{{ route('admin.questions.destroy', $question->type) }}"
                                            method="POST" class="inline"
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
