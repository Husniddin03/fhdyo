<x-admin.main page="admin.users.show" title="{{ $user->name }}">
    <div class="lg:ps-75 flex grow flex-col">

        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
            <div class="text-2xl">
                <h3>Malumotlari</h3>
            </div>
            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Ismi</th>
                                <th>Email</th>
                                <th>role</th>
                                <th>Sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->role }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($user->update_at)->format('Y-m-d') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.admin.edit', $user->id) }}">
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                                class="icon-[tabler--pencil] size-5"></span></button>
                                    </a>
                                    <form action="{{ route('admin.admin.destroy', $user->id) }}" method="POST"
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
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-2xl">
                <h3>Qo'shimcha</h3>
            </div>
            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
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

                            <tr>
                                <td>{{ $user->data->jshshir ?? '' }}</td>
                                <td>{{ $user->data->passport_id ?? '' }}</td>
                                <td>{{ $user->data->phone ?? '' }}</td>
                                <td>{{ $user->data->province ?? '' }}</td>
                                <td>{{ $user->data->region ?? '' }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($user->update_at)->format('Y-m-d') }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.admin.edit', $user->id) }}">
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button"><span
                                                class="icon-[tabler--pencil] size-5"></span></button>
                                    </a>
                                    <form action="{{ route('admin.admin.destroy', $user->id) }}" method="POST"
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
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- / Content -->
    </div>
</x-admin.main>
