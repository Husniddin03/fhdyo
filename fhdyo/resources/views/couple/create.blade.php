<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<x-app title="couple">
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold text-gray-900">Create couple</h1>

        <div class="flex justify-center items-center gap-2">
            <a href="{{ route('couples.index') }}"
                class="mx-3 flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                <h4 class="">Back</h4>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
            </a>
        </div>

    </div>
    <div class="mt-4 p-6 bg-white rounded-lg shadow-md">
        <form action="{{ route('couples.store') }}" method="POST" class="space-y-4 flex flex-wrap flex-row gap-4">
            @csrf
            @method('POST')

            <div class="w-auto">
                <label for="husband" class="block text-sm font-medium text-gray-700">Husband</label>
                <select required name="husband" id="husband"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="" {{ old('husband') == '' ? 'selected' : '' }}>Select human</option>
                    @foreach ($humans as $human)
                        @if ($human->gender == 'male')
                            <option value="{{ $human->id }}" {{ old('husband') == $human->id ? 'selected' : '' }}>
                                {{ $human->first_name }} {{ $human->middle_name }} {{ $human->last_name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="w-auto">
                <label for="wife" class="block text-sm font-medium text-gray-700">Wife</label>
                <select required name="wife" id="wife"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="" {{ old('wife') == '' ? 'selected' : '' }}>Select human</option>
                    @foreach ($humans as $human)
                        @if ($human->gender == 'female')
                            <option value="{{ $human->id }}" {{ old('wife') == $human->id ? 'selected' : '' }}>
                                {{ $human->first_name }} {{ $human->middle_name }} {{ $human->last_name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="w-auto">
                <label for="wife" class="block text-sm font-medium text-gray-700">Sattus</label>
                <select required name="status" id="status"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2">
                    <option value="" {{ old('status') == '' ? 'selected' : '' }}>Select status</option>
                    <option value="married" {{ old('status') == 'married' ? 'selected' : '' }}>
                        Married
                    </option>
                    <option value="unmarried" {{ old('status') == 'unmarried' ? 'selected' : '' }}>
                        Unmarried
                    </option>
                    <option value="divorced" {{ old('status') == 'divorced' ? 'selected' : '' }}>
                        Divorced
                    </option>
                </select>
            </div>

            <div class="w-full flex justify-between mt-4">
                <div class="w-auto flex items-end">
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Create</button>
                </div>
                <div class="flex w-auto items-end justify-center gap-2">
                    <a href="{{ route('couples.index') }}"
                        class="flex justify-center items-center gap-2 border p-2 rounded-md border-gray-300">
                        <h4 class="">Back</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                        </svg>
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app>


<script>
    $(document).ready(function() {
        $('#husband').select2({
            placeholder: 'Search husband...',
            allowClear: true
        });

        $('#wife').select2({
            placeholder: 'Search wife...',
            allowClear: true
        });
    });
</script>
