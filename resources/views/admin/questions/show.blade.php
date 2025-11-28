<x-admin.main page="admin.questions.show" title="{{ $questions[0]->type }} toifasi">

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
                                <th>Savollar</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <span class="badge badge-soft badge-success text-xs">Professional</span>
                                <span class="badge badge-soft badge-error text-xs">Rejected</span>
                                <span class="badge badge-soft badge-info text-xs">Applied</span> --}}
                            @foreach ($questions as $question)
                                <tr>
                                    <td>{{ $question->question }}</td>

                                    <td>
                                        <a href="{{ route('admin.questions.create', 'type='.$question->type) }}">
                                            <button class="btn btn-circle btn-text btn-sm"
                                                aria-label="Action button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-5"
                                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 4.5v15m7.5-7.5h-15" />
                                                </svg>
                                            </button>
                                        </a>

                                        <a href="{{ route('admin.questions.edit', $question->id) }}">
                                            <button class="btn btn-circle btn-text btn-sm"
                                                aria-label="Action button"><span
                                                    class="icon-[tabler--pencil] size-5"></span></button>
                                        </a>
                                        <form action="{{ route('admin.questions.destroy', $question->id) }}"
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
