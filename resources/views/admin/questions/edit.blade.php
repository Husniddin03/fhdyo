<x-admin.main page="admin.questions.edit" title="Toifani yangilash">

    <!-- Layout Container -->
    <!-- Layout Container -->
    <div class="lg:ps-75 flex grow flex-col">
        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">

            <!-- Form Card -->
            <form action="{{ route('admin.questions.update', $questions[0]->type) }}" method="POST" class="space-y-6">
                @csrf

                
                <!-- Header -->
                <div class="mx-auto w-full max-w-7xl">
                    <nav class="shadow rounded-md py-4 px-6 mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold">
                            <input type="text" name="type" value="{{ $questions[0]->type }}">
                        </h3>
                        <span class="text-sm">
                            Savollar soni: {{ $count ?? 0 }}
                        </span>
                    </nav>
                </div>

                <!-- Table Container -->
                <div class="rounded-lg shadow-md w-full overflow-x-auto">
                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2">#</th>
                                <th class="px-4 py-2">Savol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($questions as $question)
                                <tr class="border-b">
                                    <td class="px-4 py-2 font-medium">{{ $i + 1 }}</td>
                                    <td class="p-0">
                                        <textarea name="questions[]" required placeholder="{{ $i + 1 }} - Savolni kiriting ..." class="block w-full h-full min-h-[80px] px-4 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{ $question->question }}</textarea>
                                    </td>
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit"
                        class="btn btn-success w-full py-3 tefont-semibold hover:bg-green-600 transition-all duration-200">
                        Savollarni saqlash
                    </button>
                </div>
            </form>

        </main>
        <!-- / Content -->
    </div>

</x-admin.main>
