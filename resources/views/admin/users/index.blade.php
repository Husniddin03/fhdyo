<x-admin.main page="admin.users.index">

    <!-- Layout Container -->
    <div class="lg:ps-75 flex grow flex-col">
        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Er</th>
                                <th>Xotin</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <span class="badge badge-soft badge-success text-xs">Professional</span>
                                <span class="badge badge-soft badge-error text-xs">Rejected</span>
                                <span class="badge badge-soft badge-info text-xs">Applied</span> --}}
                            @foreach ($users as $user)
                                <tr>
                                    @php

                                        if (isset($user->couple)) {
                                            $couple = $users->find($user->couple);
                                        }

                                    @endphp
                                    <td>{{ $user->gender == 'Erkak' ? $user->name : $couple->name }}</td>
                                    <td>{{ $user->gender == 'Ayol' ? $couple->name : $user->name }}</td>

                                    <td>
                                        @if (isset($user->married) || isset($user->unMarried))
                                            <span class="badge badge-soft badge-success text-xs">Nikohda</span>
                                        @else
                                            <span class="badge badge-soft badge-error text-xs">Ajrashgan</span>
                                        @endif
                                    </td>
                                    @if (isset($user->married))
                                        <td>
                                            {{ \Carbon\Carbon::parse($user->married->married)->format('Y-m-d') }}
                                        </td>
                                    @elseif(isset($user->unMarried))
                                        <td>
                                            {{ \Carbon\Carbon::parse($user->un_married)->format('Y-m-d') }}
                                        </td>
                                    @else
                                        <td>Turmush qurmagan</td>
                                    @endif
                                    <td>
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                                class="icon-[tabler--pencil] size-5"></span></button>
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                                class="icon-[tabler--trash] size-5"></span></button>
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                                class="icon-[tabler--dots-vertical] size-5"></span></button>
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
