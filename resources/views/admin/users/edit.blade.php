<x-admin.main page='admin.users.update' title="Foydalanuvchi malumotlarini yangilash">
    <div class="lg:ps-75 flex grow flex-col">
        <!-- Content -->
        <main class="mx-auto w-full max-w-[1280px] flex-1 grow space-y-6 p-6">
            <div class="card mb-6">
                <div class="card-body gap-6">
                    <div class="border-base-content/20 flex items-end gap-6 border-b pb-4">
                        <h2 class="text-3xl">Foydalanuvchi malumotlari</h2>
                    </div>
                    <form class="space-y-6" method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="_method" value="PUT">

                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div>
                                <label class="label-text" for="name">To'liq ismi</label>
                                <input value="{{ $user->name }}" type="text" id="name" name="name"
                                    class="input" placeholder="John" />
                                <p class="text-error">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label class="label-text" for="genter">Jinsi</label>
                                <div class="max-w-full">
                                    <select name="gender"
                                        data-select='{
                                                        "placeholder": "Jinsni tanlang",
                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                        "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                                        "hasSearch": true,
                                                        "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                                        "optionClasses": "advance-select-option selected:select-active",
                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                                        "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                                        }'
                                        class="hidden">
                                        <option value="{{ $user->gender }}" selected>{{ $user->gender }}</option>
                                        <option value="Erkak">Erkak</option>
                                        <option value="Ayol">Ayol</option>
                                    </select>
                                    <p class="text-error">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div>
                                <label class="label-text" for="jshshir">Jshshir</label>
                                <input value="{{ $user->data->jshshir }}" type="jshshir" id="jshshir" name="jshshir"
                                    class="input" placeholder="12345678901234" />
                                <p class="text-error">
                                    @error('jshshir')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label class="label-text" for="pasport_id">Pasport ID</label>
                                <input value="{{ $user->data->passport_id }}" type="text" id="pasport_id"
                                    name="passport_id" class="input" placeholder="AD0123456" />
                                <p class="text-error">
                                    @error('passport_id')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label class="label-text" for="number">Telefon</label>
                                <input value="{{ $user->data->phone }}" type="text" id="number" name="phone"
                                    class="input" placeholder="+(998) 99 999 99 99" />
                                <p class="text-error">
                                    @error('phone')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div>
                                <label class="label-text" for="coutry">Viloyat</label>
                                <div class="max-w-full">
                                    <select name="province"
                                        data-select='{
                                                        "placeholder": "Viloyatni tanlang",
                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                        "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                                        "hasSearch": true,
                                                        "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                                        "optionClasses": "advance-select-option selected:select-active",
                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                                        "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                                        }'
                                        class="hidden">

                                        <option value="{{ $user->data->province }}" selected>
                                            {{ $user->data->province }}</option>
                                        <option value="Toshkent">Toshkent</option>
                                        <option value="Andijon">Andijon</option>
                                        <option value="Buxoro">Buxoro</option>
                                        <option value="Farg'ona">Farg'ona</option>
                                        <option value="Jizzax">Jizzax</option>
                                        <option value="Xorazm">Xorazm</option>
                                        <option value="Namangan">Namangan</option>
                                        <option value="Navoiy">Navoiy</option>
                                        <option value="Qashqadaryo">Qashqadaryo</option>
                                        <option value="Qoraqalpog'iston">Qoraqalpog'iston Respublikasi</option>
                                        <option value="Samarqand">Samarqand</option>
                                        <option value="Sirdaryo">Sirdaryo</option>
                                        <option value="Surxondaryo">Surxondaryo</option>
                                        <option value="Toshkent viloyati">Toshkent viloyati</option>
                                    </select>
                                    <p class="text-error">
                                        @error('province')
                                            {{ $message }}
                                        @enderror
                                    </p>
                                </div>
                            </div>
                            <div>
                                <label class="label-text" for="language">Tuman</label>
                                <div class="max-w-full">
                                    <select name="region"
                                        data-select='{
                                                        "placeholder": "Tumanni tanlang",
                                                        "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
                                                        "toggleClasses": "advance-select-toggle select-disabled:pointer-events-none select-disabled:opacity-40",
                                                        "hasSearch": true,
                                                        "dropdownClasses": "advance-select-menu max-h-52 pt-0 overflow-y-auto",
                                                        "optionClasses": "advance-select-option selected:select-active",
                                                        "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
                                                        "extraMarkup": "<span class=\"icon-[tabler--chevron-down] shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
                                                        }'
                                        class="hidden">
                                        <option value="">Tumanilar</option>
                                        <option value="{{ $user->data->region }}" selected>
                                            {{ $user->data->region }}</option>


                                        <!-- Toshkent shahri -->
                                        <option value="Bektemir">Bektemir</option>
                                        <option value="Chilonzor">Chilonzor</option>
                                        <option value="Mirobod">Mirobod</option>
                                        <option value="Mirzo Ulug'bek">Mirzo Ulug'bek</option>
                                        <option value="Olmazor">Olmazor</option>
                                        <option value="Sergeli">Sergeli</option>
                                        <option value="Shayxontohur">Shayxontohur</option>
                                        <option value="Uchtepa">Uchtepa</option>
                                        <option value="Yakkasaroy">Yakkasaroy</option>
                                        <option value="Yashnobod">Yashnobod</option>
                                        <option value="Yunusobod">Yunusobod</option>

                                        <!-- Andijon viloyati -->
                                        <option value="Andijon shahri">Andijon shahri</option>
                                        <option value="Xonobod shahri">Xonobod shahri</option>
                                        <option value="Asaka">Asaka</option>
                                        <option value="Andijon tumani">Andijon tumani</option>
                                        <option value="Baliqchi">Baliqchi</option>
                                        <option value="Bo'z">Bo'z</option>
                                        <option value="Buloqboshi">Buloqboshi</option>
                                        <option value="Jalaquduq">Jalaquduq</option>
                                        <option value="Izboskan">Izboskan</option>
                                        <option value="Qo'rg'ontepa">Qo'rg'ontepa</option>
                                        <option value="Marhamat">Marhamat</option>
                                        <option value="Oltinko'l">Oltinko'l</option>
                                        <option value="Paxtaobod">Paxtaobod</option>
                                        <option value="Ulug'nor">Ulug'nor</option>
                                        <option value="Xo'jaobod">Xo'jaobod</option>
                                        <option value="Shahrixon">Shahrixon</option>

                                        <!-- Buxoro viloyati -->
                                        <option value="Buxoro shahri">Buxoro shahri</option>
                                        <option value="Kogon shahri">Kogon shahri</option>
                                        <option value="Buxoro tumani">Buxoro tumani</option>
                                        <option value="Vobkent">Vobkent</option>
                                        <option value="G'ijduvon">G'ijduvon</option>
                                        <option value="Jondor">Jondor</option>
                                        <option value="Kogon tumani">Kogon tumani</option>
                                        <option value="Olot">Olot</option>
                                        <option value="Peshku">Peshku</option>
                                        <option value="Qorako'l">Qorako'l</option>
                                        <option value="Qorovulbozor">Qorovulbozor</option>
                                        <option value="Romitan">Romitan</option>
                                        <option value="Shofirkon">Shofirkon</option>

                                        <!-- Farg'ona viloyati -->
                                        <option value="Farg'ona shahri">Farg'ona shahri</option>
                                        <option value="Marg'ilon shahri">Marg'ilon shahri</option>
                                        <option value="Qo'qon shahri">Qo'qon shahri</option>
                                        <option value="Beshariq">Beshariq</option>
                                        <option value="Bog'dod">Bog'dod</option>
                                        <option value="Buvayda">Buvayda</option>
                                        <option value="Dang'ara">Dang'ara</option>
                                        <option value="Farg'ona tumani">Farg'ona tumani</option>
                                        <option value="Furqat">Furqat</option>
                                        <option value="O'zbekiston">O'zbekiston</option>
                                        <option value="Oltiariq">Oltiariq</option>
                                        <option value="Qo'shtepa">Qo'shtepa</option>
                                        <option value="Rishton">Rishton</option>
                                        <option value="So'x">So'x</option>
                                        <option value="Toshloq">Toshloq</option>
                                        <option value="Uchko'prik">Uchko'prik</option>
                                        <option value="Yozyovon">Yozyovon</option>

                                        <!-- Jizzax viloyati -->
                                        <option value="Jizzax shahri">Jizzax shahri</option>
                                        <option value="Arnasoy">Arnasoy</option>
                                        <option value="Baxmal">Baxmal</option>
                                        <option value="Do'stlik">Do'stlik</option>
                                        <option value="Forish">Forish</option>
                                        <option value="G'allaorol">G'allaorol</option>
                                        <option value="Sharof Rashidov">Sharof Rashidov</option>
                                        <option value="Mirzacho'l">Mirzacho'l</option>
                                        <option value="Paxtakor">Paxtakor</option>
                                        <option value="Yangiobod">Yangiobod</option>
                                        <option value="Zomin">Zomin</option>
                                        <option value="Zafarobod">Zafarobod</option>

                                        <!-- Xorazm viloyati -->
                                        <option value="Urganch shahri">Urganch shahri</option>
                                        <option value="Xiva shahri">Xiva shahri</option>
                                        <option value="Bog'ot">Bog'ot</option>
                                        <option value="Gurlan">Gurlan</option>
                                        <option value="Xonqa">Xonqa</option>
                                        <option value="Xazorasp">Xazorasp</option>
                                        <option value="Xiva tumani">Xiva tumani</option>
                                        <option value="Qo'shko'pir">Qo'shko'pir</option>
                                        <option value="Shovot">Shovot</option>
                                        <option value="Urganch tumani">Urganch tumani</option>
                                        <option value="Yangiariq">Yangiariq</option>
                                        <option value="Yangibozor">Yangibozor</option>

                                        <!-- Namangan viloyati -->
                                        <option value="Namangan shahri">Namangan shahri</option>
                                        <option value="Chortoq">Chortoq</option>
                                        <option value="Chust">Chust</option>
                                        <option value="Kosonsoy">Kosonsoy</option>
                                        <option value="Mingbuloq">Mingbuloq</option>
                                        <option value="Namangan tumani">Namangan tumani</option>
                                        <option value="Norin">Norin</option>
                                        <option value="Pop">Pop</option>
                                        <option value="To'raqo'rg'on">To'raqo'rg'on</option>
                                        <option value="Uchqo'rg'on">Uchqo'rg'on</option>
                                        <option value="Uychi">Uychi</option>
                                        <option value="Yangiqo'rg'on">Yangiqo'rg'on</option>

                                        <!-- Navoiy viloyati -->
                                        <option value="Navoiy shahri">Navoiy shahri</option>
                                        <option value="Zarafshon shahri">Zarafshon shahri</option>
                                        <option value="Xatirchi">Xatirchi</option>
                                        <option value="Karmana">Karmana</option>
                                        <option value="Qiziltepa">Qiziltepa</option>
                                        <option value="Konimex">Konimex</option>
                                        <option value="Navbahor">Navbahor</option>
                                        <option value="Nurota">Nurota</option>
                                        <option value="Tomdi">Tomdi</option>
                                        <option value="Uchquduq">Uchquduq</option>

                                        <!-- Qashqadaryo viloyati -->
                                        <option value="Qarshi shahri">Qarshi shahri</option>
                                        <option value="Chiroqchi">Chiroqchi</option>
                                        <option value="Dehqonobod">Dehqonobod</option>
                                        <option value="G'uzor">G'uzor</option>
                                        <option value="Qamashi">Qamashi</option>
                                        <option value="Qarshi tumani">Qarshi tumani</option>
                                        <option value="Kasbi">Kasbi</option>
                                        <option value="Kitob">Kitob</option>
                                        <option value="Koson">Koson</option>
                                        <option value="Mirishkor">Mirishkor</option>
                                        <option value="Muborak">Muborak</option>
                                        <option value="Nishon">Nishon</option>
                                        <option value="Shahrisabz">Shahrisabz</option>
                                        <option value="Yakkabog'">Yakkabog'</option>

                                        <!-- Qoraqalpog'iston Respublikasi -->
                                        <option value="Nukus shahri">Nukus shahri</option>
                                        <option value="Amudaryo">Amudaryo</option>
                                        <option value="Beruniy">Beruniy</option>
                                        <option value="Chimboy">Chimboy</option>
                                        <option value="Ellikqal'a">Ellikqal'a</option>
                                        <option value="Kegeyli">Kegeyli</option>
                                        <option value="Mo'ynoq">Mo'ynoq</option>
                                        <option value="Nukus tumani">Nukus tumani</option>
                                        <option value="Qonliko'l">Qonliko'l</option>
                                        <option value="Qo'ng'irot">Qo'ng'irot</option>
                                        <option value="Qorao'zak">Qorao'zak</option>
                                        <option value="Shumanay">Shumanay</option>
                                        <option value="Taxtako'pir">Taxtako'pir</option>
                                        <option value="To'rtko'l">To'rtko'l</option>
                                        <option value="Xo'jayli">Xo'jayli</option>
                                        <option value="Bo'zatov">Bo'zatov</option>

                                        <!-- Samarqand viloyati -->
                                        <option value="Samarqand shahri">Samarqand shahri</option>
                                        <option value="Bulung'ur">Bulung'ur</option>
                                        <option value="Jomboy">Jomboy</option>
                                        <option value="Ishtixon">Ishtixon</option>
                                        <option value="Kattaqo'rg'on">Kattaqo'rg'on</option>
                                        <option value="Narpay">Narpay</option>
                                        <option value="Nurobod">Nurobod</option>
                                        <option value="Oqdaryo">Oqdaryo</option>
                                        <option value="Paxtachi">Paxtachi</option>
                                        <option value="Payariq">Payariq</option>
                                        <option value="Pastdarg'om">Pastdarg'om</option>
                                        <option value="Samarqand tumani">Samarqand tumani</option>
                                        <option value="Toyloq">Toyloq</option>
                                        <option value="Urgut">Urgut</option>

                                        <!-- Sirdaryo viloyati -->
                                        <option value="Guliston shahri">Guliston shahri</option>
                                        <option value="Shirin shahri">Shirin shahri</option>
                                        <option value="Yangiyer shahri">Yangiyer shahri</option>
                                        <option value="Oqoltin">Oqoltin</option>
                                        <option value="Boyovut">Boyovut</option>
                                        <option value="Guliston tumani">Guliston tumani</option>
                                        <option value="Xovos">Xovos</option>
                                        <option value="Mirzaobod">Mirzaobod</option>
                                        <option value="Sardoba">Sardoba</option>
                                        <option value="Sayxunobod">Sayxunobod</option>
                                        <option value="Sirdaryo">Sirdaryo</option>

                                        <!-- Surxondaryo viloyati -->
                                        <option value="Termiz shahri">Termiz shahri</option>
                                        <option value="Angor">Angor</option>
                                        <option value="Boysun">Boysun</option>
                                        <option value="Denov">Denov</option>
                                        <option value="Jarqo'rg'on">Jarqo'rg'on</option>
                                        <option value="Qiziriq">Qiziriq</option>
                                        <option value="Qumqo'rg'on">Qumqo'rg'on</option>
                                        <option value="Muzrobod">Muzrobod</option>
                                        <option value="Oltinsoy">Oltinsoy</option>
                                        <option value="Sariosiyo">Sariosiyo</option>
                                        <option value="Sherobod">Sherobod</option>
                                        <option value="Sho'rchi">Sho'rchi</option>
                                        <option value="Termiz tumani">Termiz tumani</option>
                                        <option value="Uzun">Uzun</option>

                                        <!-- Toshkent viloyati -->
                                        <option value="Olmaliq shahri">Olmaliq shahri</option>
                                        <option value="Angren shahri">Angren shahri</option>
                                        <option value="Bekobod shahri">Bekobod shahri</option>
                                        <option value="Chirchiq shahri">Chirchiq shahri</option>
                                        <option value="Ohangaron shahri">Ohangaron shahri</option>
                                        <option value="Nurafshon shahri">Nurafshon shahri</option>
                                        <option value="Zangiota shahri">Zangiota shahri</option>
                                        <option value="Bekobod tumani">Bekobod tumani</option>
                                        <option value="Bo'stonliq">Bo'stonliq</option>
                                        <option value="Bo'ka">Bo'ka</option>
                                        <option value="Chinoz">Chinoz</option>
                                        <option value="Qibray">Qibray</option>
                                        <option value="Ohangaron tumani">Ohangaron tumani</option>
                                        <option value="Oqqo'rg'on">Oqqo'rg'on</option>
                                        <option value="Parkent">Parkent</option>
                                        <option value="Piskent">Piskent</option>
                                        <option value="Quyi Chirchiq">Quyi Chirchiq</option>
                                        <option value="O'rtachirchiq">O'rtachirchiq</option>
                                        <option value="Toshkent tumani">Toshkent tumani</option>
                                        <option value="Yuqori Chirchiq">Yuqori Chirchiq</option>
                                        <option value="Yangiyo'l">Yangiyo'l</option>
                                    </select>
                                    <p class="text-error">
                                        @error('region')
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
