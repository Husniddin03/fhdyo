<x-admin.main page='admin.admin.create' title="Yangi admin yaratish">
    <div class="lg:ps-75 flex grow flex-col">
        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
            <div class="card mb-6">
                <div class="card-body gap-6">
                    <div class="border-base-content/20 flex items-end gap-6 border-b pb-4">
                        <h2 class="text-3xl">Foydalanuvchi malumotlari</h2>
                    </div>
                    <form class="space-y-6" method="POST" action="{{ route('admin.admin.store') }}">
                        @csrf
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label class="label-text" for="name">To'liq ismi</label>
                                <input value="{{ old('name') }}" type="text" id="name" name="name"
                                    class="input" placeholder="John" />
                                <p class="text-error">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label class="label-text" for="email">Email</label>
                                <input value="{{ old('email') }}" type="email" id="email" name="email"
                                    class="input" placeholder="12345678901234" />
                                <p class="text-error">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label class="label-text" for="pasport_id">Parol</label>
                                <input value="{{ old('password') }}" type="text" id="pasport_id"
                                    name="password" class="input" placeholder="AD0123456" />
                                <p class="text-error">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label class="label-text" for="coutry">Roli</label>
                                <div class="max-w-full">
                                    <select name="role"
                                        data-select='{
                                                        "placeholder": "Rolni tanlang",
                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                        "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                                        "hasSearch": true,
                                                        "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                                        "optionClasses": "advance-select-option selected:select-active",
                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                                        "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                                        }'
                                        class="hidden">

                                        <option value="{{ old('role') }}" selected>{{ old('role') }}</option>
                                        <option value="admin">Admin</option>
                                        <option value="super_admin">Supper admin</option>
                                    </select>
                                    <p class="text-error">
                                        @error('role')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex gap-3">
                            <button class="btn btn-primary" type="submit">Saqlash</button>
                            <button class="btn btn-seconadry btn-secondary">Tozalash</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
    </div>

</x-admin.main>
