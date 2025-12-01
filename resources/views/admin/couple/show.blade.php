<x-admin.main page="admin.couple.show" title="Test natijalari">

    <!-- Layout Container -->
    <div class="lg:ps-75 flex grow flex-col">

        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">

            <div class="rounded-box shadow-base-300/10 bg-base-100 w-full pb-2 shadow-md">
                <div class="overflow-x-auto">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Savollar</th>

                                @if ($couple->firstUser->gender == 'Erkak')
                                    <th>{{ $couple->firstUser->name }}</th>
                                    <th>{{ $couple->secondUser->name }}</th>
                                @else
                                    <th>{{ $couple->secondUser->name }}</th>
                                    <th>{{ $couple->firstUser->name }}</th>
                                @endif
                                <th>Moslik</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- <span class="badge badge-soft badge-success text-xs">Professional</span>
                                <span class="badge badge-soft badge-error text-xs">Rejected</span>
                                <span class="badge badge-soft badge-info text-xs">Applied</span> --}}
                            @foreach ($data1 as $item)
                                <tr>
                                    <td>{{ $item['question'] }}</td>
                                    @if ($item['first'] == 1)
                                        <td><span class="badge badge-soft badge-success text-xs">Ha</span></td>
                                    @else
                                        <td><span class="badge badge-soft badge-error text-xs">Yo'q</span></td>
                                    @endif
                                    @if ($item['second'] == 1)
                                        <td><span class="badge badge-soft badge-success text-xs">Ha</span></td>
                                    @else
                                        <td><span class="badge badge-soft badge-error text-xs">Yo'q</span></td>
                                    @endif
                                    @if ($item['check'])
                                        <td><span class="badge badge-soft badge-success text-xs">Ha</span></td>
                                    @else
                                        <td><span class="badge badge-soft badge-error text-xs">Yo'q</span></td>
                                    @endif
                                </tr>
                            @endforeach
                            <tr>
                                <td>Umumiy Natija</td>
                                <td>{{ $all['first'] }} ta <span
                                        class="badge badge-soft badge-success text-xs">Ha</span>
                                    {{ count($data1) - $all['first'] }} ta
                                    <span class="badge badge-soft badge-error text-xs">Yo'q</span>
                                </td>

                                </td>
                                <td>{{ $all['second'] }} ta <span
                                        class="badge badge-soft badge-success text-xs">Ha</span>
                                    {{ count($data1) - $all['second'] }} ta <span
                                        class="badge badge-soft badge-error text-xs">Yo'q</span> </td>
                                @if ($all['all'] >= 75)
                                    <td><span class="badge badge-soft badge-success text-xs">{{ $all['all'] }} %
                                            moslik</span></td>
                                @elseif($all['all'] >= 50)
                                    <td><span class="badge badge-soft badge-info text-xs">{{ $all['all'] }} %
                                            moslik</span></td>
                                @else
                                    <td><span class="badge badge-soft badge-error text-xs">{{ $all['all'] }} %
                                            moslik</span></td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <!-- / Content -->
    </div>
</x-admin.main>
