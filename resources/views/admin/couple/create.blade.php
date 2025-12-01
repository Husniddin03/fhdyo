<x-admin.main page='admin.couple.create' title="Yangi juftlik yaratish">
    <div class="lg:ps-75 flex grow flex-col">
        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
            <div class="card mb-6">
                <div class="card-body gap-6">
                    <div class="border-base-content/20 flex items-end gap-6 border-b pb-4">
                        <h2 class="text-3xl">Juftliklar malumotlari</h2>
                    </div>
                    <form class="space-y-6" method="POST" action="{{ route('admin.couple.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label class="label-text" for="coutry">Birinchi ishtirokchi</label>
                                <div class="max-w-full">
                                    <select name="first_user_id"
                                        data-select='{
                                                        "placeholder": "Birinchi ishtirokchi",
                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                        "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                                        "hasSearch": true,
                                                        "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                                        "optionClasses": "advance-select-option selected:select-active",
                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                                        "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                                        }'
                                        class="hidden">
                                        <option value="" selected disabled>Birinchi ishtirikchi</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-error">
                                        @error('province')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div>
                                <label class="label-text" for="coutry">Ikkinchi ishtirokchi</label>
                                <div class="max-w-full">
                                    <select name="second_user_id"
                                        data-select='{
                                                        "placeholder": "Ikkinchi ishtirikchi",
                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                        "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                                        "hasSearch": true,
                                                        "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                                        "optionClasses": "advance-select-option selected:select-active",
                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                                        "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                                        }'
                                        class="hidden">
                                        <option value="" selected disabled>Ikkinchi ishtirikchi</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-error">
                                        @error('province')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div>
                                <label class="label-text" for="name">Soni</label>
                                <div>Barcha bo'limlardan savollar soni</div>
                            </div>
                            <div>
                                <label class="label-text" for="name">Soni</label>
                                <input value="{{ old('number') }}" type="number" id="number" name="number"
                                    class="input" placeholder="Soni" />
                                <p class="text-error">
                                    @error('number')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex gap-3">
                            <button class="btn btn-primary" type="submit">Yaratish</button>
                            <button class="btn btn-seconadry btn-secondary">Tozalash</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</x-admin.main>
