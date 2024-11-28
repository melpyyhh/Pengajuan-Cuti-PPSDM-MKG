<x-guest-layout>
    <div class="flex h-screen">
        <!-- Kiri: Deskripsi -->
        <div class="w-1/2 bg-primary text-white flex flex-col justify-center items-center p-10">
            <h1 class="text-4xl font-bold mb-4 text-center">Sistem Pengajuan Cuti</h1>
            <h1 class="text-4xl font-bold mb-4 text-center">PPSDM BMKG</h1>
            <p class="mt-4 text-lg text-center tracking-widest">
                Masukkan NIP atau email BMKG dan kata sandi Anda untuk mengakses.
            </p>
            <img src="/path/to/mascot.png" alt="Maskot BMKG" class="mt-6 w-40">
        </div>

        <!-- Kanan: Form Login -->
        <div class="w-1/2 bg-secondary flex flex-col justify-center items-center p-10 h-full">
            <form method="POST" action="{{ route('login') }}"
                class="w-[675px] h-[800px] bg-white p-10 rounded-lg flex flex-col justify-center">
                @csrf
                <img src="/img/BMKG.png" alt="BMKG Logo" class="mb-8 w-40 mx-auto">
                <div class="mb-4">
                    <label for="email" class="block text-lg font-bold ">NIP atau Email BMKG</label>
                    <input type="text" name="email" id="email" placeholder="Masukkan NIP atau email BMKG"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-full shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-center tracking-widest">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-lg font-bold">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan kata sandi"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-full shadow-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm text-center tracking-widest">
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember-me</label>
                    </div>
                </div>
                <div>
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-blue-600 hover:underline tracking-widest">
                        Lupa kata sandi? Klik disini
                    </a>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="w-[200px] h-[50px] py-3 px-6 border border-transparent rounded-full shadow-md text-xl font-bold text-white bg-tertiary hover:bg-orange-600 focus:outline-none focus:ring-4 focus:ring-offset-2 focus:ring-orange-500">
                            Sign In
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
