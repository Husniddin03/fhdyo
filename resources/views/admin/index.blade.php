<x-admin.main page="admin.index" title="Asosiy sahifa">

    <!-- Layout Container -->
    <div class="lg:ps-75 flex grow flex-col">
        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
            <!-- Stats -->
            <div class="shadow-base-300/10 rounded-box bg-base-100 flex gap-4 p-6 shadow-md max-xl:flex-col">
                <div class="flex flex-1 gap-4 max-sm:flex-col">
                    <div class="flex flex-1 flex-col gap-4">
                        <div class="text-base-content flex items-center gap-2">
                            <div class="avatar avatar-placeholder">
                                <div class="bg-base-200 rounded-field size-9">
                                    <span class="icon-[tabler--eye] size-5"></span>
                                </div>
                            </div>
                            <h5 class="text-lg font-medium">Alo ko'rsatkich foizlari</h5>
                        </div>
                        <div>
                            <div class="text-base-content text-xl font-semibold">17,356</div>
                            <div class="flex items-center gap-2 text-sm font-semibold">
                                <span class="text-success inline-flex items-center gap-1">
                                    <span class="icon-[tabler--arrow-up] size-4"></span>
                                    25.6%
                                </span>
                                <span class="text-base-content/50 font-medium">EPC: 308.20</span>
                            </div>
                        </div>
                    </div>
                    <div class="divider sm:divider-horizontal"></div>
                    <div class="flex flex-1 flex-col gap-4">
                        <div class="text-base-content flex items-center gap-2">
                            <div class="avatar avatar-placeholder">
                                <div class="bg-base-200 rounded-field size-9">
                                    <span class="icon-[tabler--eye] size-5"></span>
                                </div>
                            </div>
                            <h5 class="text-lg font-medium">Yaxshi ko'rsatkich foizlari</h5>
                        </div>
                        <div>
                            <div class="text-base-content text-xl font-semibold">17,356</div>
                            <div class="flex items-center gap-2 text-sm font-semibold">
                                <span class="text-sky-500 inline-flex items-center gap-1">
                                    <span class="icon-[tabler--arrow-up] size-4"></span>
                                    25.6%
                                </span>
                                <span class="text-base-content/50 font-medium">EPC: 308.20</span>
                            </div>
                        </div>
                    </div>
                    <div class="divider sm:divider-horizontal"></div>
                    <div class="flex flex-1 flex-col gap-4">
                        <div class="text-base-content flex items-center gap-2">
                            <div class="avatar avatar-placeholder">
                                <div class="bg-base-200 rounded-field size-9">
                                    <span class="icon-[tabler--mouse] size-6"></span>
                                </div>
                            </div>
                            <h5 class="text-lg font-medium">Yomon ko'rsatkich foizlari</h5>
                        </div>
                        <div>
                            <div class="text-base-content text-xl font-semibold">2,784</div>
                            <div class="flex items-center gap-2 text-sm font-semibold">
                                <span class="text-error inline-flex items-center gap-1">
                                    <span class="icon-[tabler--arrow-down] size-4"></span>
                                    25.6%
                                </span>
                                <span class="text-base-content/50 font-medium">Related Value: 77,359</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="divider xl:divider-horizontal"></div>
            </div>

            <div class="grid gap-6 xl:grid-cols-3">
                <div class="flex flex-col gap-6 md:flex-row xl:flex-col">
                    <!-- Meeting Schedules -->
                    <div class="card shadow-base-300/10 grow shadow-md">
                        <div class="card-header flex items-center justify-between gap-2">
                            <h4 class="card-title text-xl">Jarayondagi testlar</h4>
                            <div class="dropdown relative inline-flex">
                                <button id="dropdown-meeting-schedules" type="button"
                                    class="dropdown-toggle btn btn-text text-base-content/50 btn-circle btn-sm"
                                    aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                                    <span class="icon-[tabler--dots-vertical] size-5.5"></span>
                                </button>
                                <ul class="dropdown-menu dropdown-open:opacity-100 hidden" role="menu"
                                    aria-orientation="vertical" aria-labelledby="dropdown-meeting-schedules">
                                    <li><a class="dropdown-item" href="#">Last 28 Days</a></li>
                                    <li><a class="dropdown-item" href="#">Last Month</a></li>
                                    <li><a class="dropdown-item" href="#">Last Year</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="flex h-full flex-col justify-between gap-6">
                                <li>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="rounded-field size-10">
                                                <img src={{ Vite::asset('resources/assets/img/avatars/1.png') }}
                                                    alt="avatar" />
                                            </div>
                                        </div>

                                        <div class="grow">
                                            <h6 class="text-base-content mb-px font-medium">Call with woods</h6>
                                            <div class="text-base-content/50 flex items-center gap-1 text-sm">
                                                <span class="icon-[tabler--calendar] size-4.5"></span>
                                                <span>1 Jul | 08:20-10:20</span>
                                            </div>
                                        </div>
                                        <span
                                            class="badge badge-primary badge-soft rounded-field font-medium">Business</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="rounded-field size-10">
                                                <img src={{ Vite::asset('resources/assets/img/avatars/2.png') }}
                                                    alt="avatar" />
                                            </div>
                                        </div>

                                        <div class="grow">
                                            <h6 class="text-base-content mb-px font-medium">Conference call</h6>
                                            <div class="text-base-content/50 flex items-center gap-1 text-sm">
                                                <span class="icon-[tabler--calendar] size-4.5"></span>
                                                <span>22 Jul | 02:00-3:30</span>
                                            </div>
                                        </div>
                                        <span
                                            class="badge badge-warning badge-soft rounded-field font-medium">Dinner</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="rounded-field size-10">
                                                <img src={{ Vite::asset('resources/assets/img/avatars/3.png') }}
                                                    alt="avatar" />
                                            </div>
                                        </div>

                                        <div class="grow">
                                            <h6 class="text-base-content mb-px font-medium">Meeting with John</h6>
                                            <div class="text-base-content/50 flex items-center gap-1 text-sm">
                                                <span class="icon-[tabler--calendar] size-4.5"></span>
                                                <span>22 Jul | 11:15-12:15</span>
                                            </div>
                                        </div>
                                        <span
                                            class="badge badge-neutral badge-soft rounded-field font-medium">Meetup</span>
                                    </div>
                                </li>
                                <li>
                                    <div class="flex items-center gap-3">
                                        <div class="avatar">
                                            <div class="rounded-field size-10">
                                                <img src={{ Vite::asset('resources/assets/img/avatars/4.png') }}
                                                    alt="avatar" />
                                            </div>
                                        </div>

                                        <div class="grow">
                                            <h6 class="text-base-content mb-px font-medium">Meeting with Sara</h6>
                                            <div class="text-base-content/50 flex items-center gap-1 text-sm">
                                                <span class="icon-[tabler--calendar] size-4.5"></span>
                                                <span>23 Jul | 07:30-08:30</span>
                                            </div>
                                        </div>
                                        <span
                                            class="badge badge-error badge-soft rounded-field font-medium">Dinner</span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>

                <!-- Sales Metrics -->
                <div class="card shadow-base-300/10 shadow-md xl:col-span-2">
                    <div class="card-body gap-6">

                        <!-- Bottom Section -->
                        <div class="border-base-content/20 rounded-box flex gap-8 border p-6 max-md:flex-col">
                            <!-- Sales Plan -->
                            <div class="space-y-4">
                                <h3 class="card-title">Sales Plan</h3>
                                <div class="text-base-content text-7xl font-medium">54%</div>
                                <p class="text-base-content/50 text-lg">Percentage profit from total sales</p>
                            </div>

                            <!-- Cohort Analysis -->
                            <div class="space-y-6">
                                <h3 class="text-base-content text-xl font-medium">Cohart analysis indicators</h3>
                                <p class="text-base-content/50">Cohort analysis thoroughly analyzes the behaviour
                                    and engagement patterns of a group of users who joined a product or service at
                                    the same time, tracking their actions and retention over a certain period for
                                    deeper insights.</p>

                                <!-- Statistics Icons -->
                                <div class="text-base-content flex gap-6 max-sm:flex-col sm:items-center">
                                    <div class="flex items-center gap-2">
                                        <span class="icon-[tabler--chart-infographic] size-6"></span>
                                        <span class="text-lg font-medium">Open Statistics</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="icon-[tabler--percentage] size-6"></span>
                                        <span class="text-lg font-medium">Percentage Change</span>
                                    </div>
                                </div>

                                <div class="progress rounded-field h-7 *:rounded-none">
                                    <div class="progress-bar progress-primary w-full"></div>
                                    <div class="progress-bar bg-primary/50 w-3/4"></div>
                                    <div class="progress-bar bg-primary/30 w-2/4"></div>
                                    <div class="progress-bar bg-primary/10 w-1/4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Status Table -->
            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Birinchi ishtirokchi</th>
                                <th>Ikkinchi ishtirokchi</th>
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
                            @foreach ($couples as $couple)
                                <tr>
                                    @if ($couple->firstUser->gender == 'Erkak')
                                        <td>{{ $couple->firstUser->name }}</td>
                                        <td>{{ $couple->secondUser->name }}</td>
                                    @else
                                        <td>{{ $couple->secondUser->name }}</td>
                                        <td>{{ $couple->firstUser->name }}</td>
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
                                        <div class="flex items-center">
                                            <div class="progress w-56" role="progressbar"
                                                aria-label="Rounded Progressbar" aria-valuenow="72" aria-valuemin="0"
                                                aria-valuemax="100">

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
                                        <a href="{{ route('admin.couple.show', $couple->id) }}">
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
                                        <form action="{{ route('admin.couple.destroy', $couple->id) }}"
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
