<x-guest-layout>
    <div class="flex h-screen">
        <!-- Kiri: Deskripsi -->
        <div class="w-1/2 bg-primary text-white flex flex-col justify-center items-center p-10">
            <h1 class="text-4xl font-bold mb-4">Sistem Pengajuan Cuti</h1>
            <h2 class="text-2xl">PPSDM BMKG</h2>
            <p class="mt-4 text-lg text-center">
                Masukkan NIP atau email BMKG dan kata sandi Anda untuk mengakses.
            </p>
            <img src="/path/to/mascot.png" alt="Maskot BMKG" class="mt-6 w-40">
        </div>

        <!-- Kanan: Form Login -->
        <div class="w-1/2 bg-secondary flex flex-col justify-center items-center p-10">
            <img src="/img/BMKG.png" alt="BMKG Logo" class="mb-6 w-32">
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm bg-white p-6 rounded-lg shadow">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">NIP atau Email BMKG</label>
                    <input type="text" name="email" id="email" placeholder="Masukkan NIP atau email BMKG"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="Masukkan kata sandi"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input id="remember-me" name="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                        <label for="remember-me" class="ml-2 block text-sm text-gray-900">Remember-me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                        Lupa kata sandi?
                    </a>
                </div>
                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-tertiary hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
