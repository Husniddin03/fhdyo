<x-admin.main page="admin.questions.edit" title="Toifa testlarini yangilang">

    <!-- Layout Container -->
    <!-- Layout Container -->
    <div class="lg:ps-75 flex grow flex-col">
        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">

            <!-- Form Card -->
            <form action="{{ route('admin.questions.update', $questions[0]->type) }}" method="POST" class="space-y-6">
                @csrf
                @method("PUT")
                <input type="hidden" value="PUT" name="_method" id="">
                <!-- Header -->
                <div class="mx-auto w-full max-w-7xl">
                    <nav class="shadow rounded-md py-4 px-6 mb-4 flex items-center justify-between">
                        <h3 class="text-lg font-semibold">
                            Testlarini yangilang!
                        </h3>
                    </nav>
                </div>

                <!-- Table Container -->
                <div class="rounded-lg shadow-md w-full overflow-x-auto p-4 space-y-4">

                    <div class="flex flex-col gap-2">
                        <label for="type" class="font-medium">Toifa nomi</label>
                        <input type="text" id="type" name="type" value="{{ $questions[0]->type }}"
                            class="border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400" />
                    </div>

                    <table class="table-auto w-full border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-left">
                                <th class="px-4 py-2">Savollar</th>
                            </tr>
                        </thead>
                        <tbody id="t-body">
                            @foreach ($questions as $question)
                                <tr class="border-b">
                                    <td class="p-0">
                                        <textarea name="questions[]" required placeholder="Savolni kiriting ..."
                                            class="block w-full h-full min-h-[80px] px-4 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400">{{$question->question}}</textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <button type="button" id="add-row"
                        class="w-full py-3 font-semibold transition-all duration-200 border rounded-md">
                        Yangi qator +
                    </button>
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


<script>
    document.getElementById("add-row").addEventListener("click", function() {

        const tbody = document.getElementById("t-body");

        const newRow = document.createElement("tr");
        newRow.className = "border-b";

        newRow.innerHTML = `
                    <td class="p-0">
                        <textarea name="questions[]" required placeholder="Savolni kiriting ..."
                            class="block w-full h-full min-h-[80px] px-4 py-2 border border-gray-300 rounded-md resize-none focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400"></textarea>
                    </td>
                `;

        tbody.appendChild(newRow);
    });
</script>
