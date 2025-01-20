<x-guest-layout>
    <div class="flex h-screen">
        <!-- Kiri: Deskripsi -->
        <div class="flex flex-col items-center justify-center w-1/2 p-10 text-white bg-primary">
            <h1 class="mb-4 text-4xl font-bold text-center">Sistem Pengajuan Cuti</h1>
            <h1 class="mb-4 text-4xl font-bold text-center">PPSDM BMKG</h1>
            <p class="mt-4 text-lg tracking-widest text-center">
                Masukkan Email dan kata sandi Anda untuk mengakses.
            </p>
            <img src="img/mascot.png" alt="Maskot BMKG" class="mt-6 w-[200px] md:w-[300px]">
        </div>

        <div class="flex flex-col items-center justify-center w-1/2 h-full p-10 bg-secondary">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form method="POST" action="{{ route('password.email') }}"
                class="w-[675px] h-[800px] bg-white p-10 rounded-lg flex flex-col justify-center">
                @csrf
                <img src="/img/BMKG.png" alt="BMKG Logo" class="w-40 mx-auto mb-8">
                <!-- Email Address -->
                <div class="mb-4">
                    <label for="email" class="block text-lg font-bold ">Email BMKG</label>
                    <input type="text" name="email" id="email" placeholder="Masukkan Email BMKG"
                        class="block w-full px-3 py-2 mt-1 tracking-widest text-center border border-gray-300 rounded-full shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="px-6 py-3 text-xl font-bold text-white border border-transparent rounded-full shadow-md bg-tertiary hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-orange-500">
                            Forgot Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
