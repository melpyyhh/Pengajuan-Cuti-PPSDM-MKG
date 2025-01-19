<x-guest-layout>
    <div class="flex flex-col h-screen md:flex-row">
        <!-- Kiri: Deskripsi -->
        <div
            class="flex-col items-center justify-center hidden w-full p-6 text-white md:flex md:w-1/2 bg-primary md:p-10">
            <h1 class="mb-4 text-2xl font-bold text-center md:text-4xl">Sistem Pengajuan Cuti</h1>
            <h1 class="mb-4 text-2xl font-bold text-center md:text-4xl">PPSDM BMKG</h1>
            <p class="mt-4 text-base tracking-widest text-center md:text-lg">
                Masukkan NIP atau email BMKG dan kata sandi Anda untuk mengakses.
            </p>
            <img src="img/mascot.png" alt="Maskot BMKG" class="mt-6 w-[200px] md:w-[300px]">
        </div>

        <!-- Bar Judul untuk ukuran kecil -->
        <div class="p-4 text-white md:hidden bg-primary">
            <a href="#" class="flex ms-2 md:me-24">
                <img src="https://upload.wikimedia.org/wikipedia/commons/1/12/Logo_BMKG_%282010%29.png" class="h-8 me-3"
                    alt="FlowBite Logo" />
                <span
                    class="self-center text-xl font-semibold tracking-wide sm:text-2xl whitespace-nowrap dark:text-white">SIPETI
                    PPSDM BMKG</span>
            </a>
        </div>

        <!-- Kanan: Form Login -->
        <div class="flex flex-col items-center justify-center w-full p-6 mt-10 md:w-1/2 bg-secondary md:p-10">
            <form method="POST" action="{{ route('login') }}"
                class="flex flex-col w-full max-w-md p-6 bg-white rounded-lg shadow-md md:p-10">
                @csrf
                <img src="/img/BMKG.png" alt="BMKG Logo" class="w-24 mx-auto mb-6 md:w-40">

                <div class="mb-4">
                    <label for="email" class="block text-sm font-bold md:text-lg">NIP atau Email BMKG</label>
                    <input type="text" name="email" id="email" placeholder="Masukkan NIP atau Email"
                        class="block w-full px-3 py-2 mt-1 tracking-widest text-center border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm md:placeholder:text-base lg:placeholder:text-lg">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="block text-sm font-bold md:text-lg">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan Kata Sandi"
                        class="block w-full px-3 py-2 mt-1 tracking-widest text-center border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm md:placeholder:text-base lg:placeholder:text-lg">
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded">
                        <label for="remember-me" class="block ml-2 text-sm text-gray-900">Remember-me</label>
                    </div>
                </div>
                <div>
                    <a href="{{ route('password.request') }}"
                        class="text-sm tracking-wider text-blue-600 hover:underline">Lupa kata sandi? Klik disini</a>
                    <div class="flex justify-center mt-4">
                        <button type="submit"
                            class="w-full md:w-[200px] py-2 px-4 md:py-3 md:px-6 border border-transparent rounded-lg shadow-md text-base md:text-xl font-bold text-white bg-tertiary hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-orange-500 tracking-wider">
                            Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
