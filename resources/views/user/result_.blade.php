<x-user.main page="user.result" title="Natija">

    <!-- Layout Container -->
    <div class="lg:ps-100 flex grow flex-col">

        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">

            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Er</th>
                                <th>Xotin</th>
                                <th>Turkum</th>
                                <th>Moslik</th>
                                <th>Sana</th>
                                <th>Amallar</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <span class="badge badge-soft badge-success text-xs">Professional</span>
                                <span class="badge badge-soft badge-error text-xs">Rejected</span>
                                <span class="badge badge-soft badge-info text-xs">Applied</span> --}}
                            <tr>
                                @if ($couple->firstUser->gender == 'Erkak')
                                    <td>{{ $couple->firstUser->name }}
                                    </td>
                                    <td>{{ $couple->secondUser->name }}
                                    </td>
                                @else
                                    <td>{{ $couple->secondUser->name }}
                                    </td>
                                    <td>{{ $couple->firstUser->name }}
                                    </td>
                                @endif

                                <td>
                                    @foreach (explode(',', $couple->questions_type) as $type)
                                        <span
                                            class="badge badge-soft badge-{{ $data[$type] >= 75 ? 'seccess' : ($data[$type] >= 50 ? 'info' : 'error') }} text-xs me-1">
                                            {{ trim($type) }} {{ $data[$type] }}%
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
                                    <div class="flex items-center">
                                        <div class="progress w-56" role="progressbar" aria-label="Rounded Progressbar"
                                            aria-valuenow="72" aria-valuemin="0" aria-valuemax="100">

                                            <div class="progress-bar progress-{{ $result }}"
                                                style="width: {{ $couple->result }}%">
                                            </div>
                                        </div>
                                        <span class="ml-2 text-base-content">{{ $couple->result }}%</span>
                                    </div>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($couple->update_at)->format('Y-m-d') }}
                                </td>
                                <td>
                                    <a href="{{ route('user.status') }}">
                                        <button class="btn btn-circle btn-text btn-sm" aria-label="Action button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                class="size-5" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                        </button>
                                    </a>
                                    <form action="{{ route('user.download') }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('Foydalanuvchi ma\'lumoti o\'chiriladi. Davom etasizmi?')">
                                        @csrf
                                        <input type="hidden" name="_method" id="" value="DELETE">
                                        <button type="submit" class="btn btn-circle btn-text btn-sm"
                                            aria-label="Action button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                            </svg>

                                        </button>
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
</x-user.main>
