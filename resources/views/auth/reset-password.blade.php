<x-guest-layout>
    <div class="flex h-screen">
        <div class="w-[900px] bg-primary text-white flex flex-col justify-center items-center p-10">
            <h1 class="text-4xl font-bold mb-4 text-center">Sistem Pengajuan Cuti</h1>
            <h1 class="text-4xl font-bold mb-4 text-center">PPSDM BMKG</h1>
            <p class="mt-4 text-lg text-center tracking-widest">
                Masukkan NIP atau email BMKG dan kata sandi Anda untuk mengakses.
            </p>
            <img src="/path/to/mascot.png" alt="Maskot BMKG" class="mt-6 w-40">
        </div>
    </div>


    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
