@php
    $data = session('data');
    $key = session('key');
@endphp

<x-user.main>
    @if (!isset($data))
        <div
            class="flex h-auto min-h-screen items-center justify-center overflow-x-hidden bg-[url('../../img/illustrations/auth-background-2.png')] bg-cover bg-center bg-no-repeat py-10">
            <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-base-100 shadow-base-300/20 z-1 sm:min-w-md w-full space-y-6 rounded-xl p-6 shadow-md lg:p-8">
                    <div>
                        <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Kalit kiriting</h3>
                    </div>
                    <div class="space-y-4">
                        <form class="mb-4 space-y-4" action="{{ route('user.checkKey') }}" method="POST">
                            @csrf
                            <div>
                                <label class="label-text">Kalit kiriting</label>
                                <input type="text" name="key" placeholder="Kalit kiriting" class="input"
                                    required />
                                @error('key')
                                    <p style="color: red;">{{ $message }}</p>
                                @enderror
                            </div>
                            <button class="btn btn-lg btn-primary btn-gradient btn-block"
                                type="submit">Tekshirish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (isset($data))
        <div
            class="flex h-auto min-h-screen items-center justify-center overflow-x-hidden bg-[url('../../img/illustrations/auth-background-2.png')] bg-cover bg-center bg-no-repeat py-10">
            <div class="relative flex items-center justify-center px-4 sm:px-6 lg:px-8">
                <div
                    class="bg-base-100 shadow-base-300/20 z-1 sm:min-w-md w-full space-y-6 rounded-xl p-6 shadow-md lg:p-8">
                    <div>
                        <h3 class="text-base-content mb-1.5 text-2xl font-semibold">Siz kimsiz</h3>
                    </div>
                    <div class="space-y-4">
                        <form class="mb-4 space-y-4" action="{{ route('user.checkKey') }}" method="POST">
                            @csrf
                            <input type="hidden" name="key" value="{{ $key ?? '' }}" />

                            <div>
                                <input type="radio" name="user_id" value="{{ $data->firstUser->id }}" id="first">
                                <label for="first">{{ $data->firstUser->name }}</label>
                            </div>

                            <div>
                                <input type="radio" name="user_id" value="{{ $data->secondUser->id }}" id="second">
                                <label for="second">{{ $data->secondUser->name }}</label>
                            </div>

                            @error('user_id')
                                <p style="color: red;">{{ $message }}</p>
                            @enderror

                            <button class="btn btn-lg btn-primary btn-gradient btn-block"
                                type="submit">Tekshirish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-user.main>
