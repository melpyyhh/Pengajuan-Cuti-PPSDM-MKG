<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-primary border-r border-gray-200">
        <div class="px-6 py-4">
            <!-- User Info -->
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gray-300 rounded-full">

                </div>
                <div>
                    <p class="text-sm font-semibold text-secondary">{{ Auth::user()->name }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-6">
            <ul class="space-y-2">
                <!-- Menu Pengaju -->
                @if (Auth::user()->hasRole('pengaju'))
                    <li>
                        <div class="px-6 text-xs font-semibold text-secondary uppercase">
                            Menu Pengaju
                        </div>
                    </li>
                    <li>
                        <a href="#" class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-gray-100">
                            <span>Riwayat Cuti</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-gray-100">
                            <span>Pengajuan</span>
                        </a>
                    </li>
                @endif

                <!-- Menu Penyetuju -->
                @if (Auth::user()->hasRole('penyetuju'))
                    <li>
                        <div class="px-6 mt-6 text-xs font-semibold text-secondary uppercase">
                            Menu Penyetuju
                        </div>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-gray-100">
                            <span>Daftar Ajuan Cuti Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-gray-100">
                            <span>Dashboard Cuti Pegawai</span>
                        </a>
                    </li>
                @endif

                <!-- Pengaduan -->
                <li>
                    <a href="#" class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-gray-100">
                        <span>Ajukan Pengaduan ke Admin</span>
                    </a>
                </li>
            </ul>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </form>
        </nav>
    </div>
</div>
