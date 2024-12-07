<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-primary border-r border-gray-200">
        <div class="px-6 py-4">
            <!-- User Info -->
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gray-300 rounded-full">

                </div>
                <div>
                    @if (auth()->user() && auth()->user()->pegawai)
                        <p class="text-sm font-semibold text-secondary">{{ auth()->user()->pegawai->nama }}</p>
                    @else
                        <p class="text-sm font-semibold text-secondary">Nama Pegawai Tidak Ditemukan</p>
                    @endif

                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="mt-6">
            <ul class="space-y-2">
                <!-- Menu Pengaju -->
                @if (Auth::user()->hasRole('pengaju'))
                <li>
                    <div class="px-6 text-lg font-semibold text-secondary uppercase">
                        Menu Pengaju
                    </div>
                    <!-- Garis Horizontal -->
                    <div class="border-t border-secondary mx-5 my-2"></div> 
                </li>
                <li>
                    <a href="/pengaju"
                        class="flex items-center px-4 py-1.5 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                        {{ request()->is('pengaju') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Riwayat Cuti</span>
                    </a>
                </li>
                <li>
                    <a href="/pengajuan-form"
                        class="flex items-center px-4 py-1.5 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors 
                    {{ request()->is('pengajuan-form') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Pengajuan</span>
                    </a>
                </li>
                <!-- Pengaduan -->
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white rounded-lg">
                            <span>Ajukan Pengaduan ke Admin</span>
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
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-tertiary hover:text-white">
                            <span>Daftar Ajuan Cuti Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-tertiary hover:text-white">
                            <span>Dashboard Cuti Pegawai</span>
                        </a>
                    </li>
                    <!-- Pengaduan -->
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white rounded-lg">
                            <span>Ajukan Pengaduan ke Admin</span>
                        </a>
                    </li>
                @endif
                {{-- Menu Admin --}}
                @if (Auth::user()->hasRole('admin'))
                    <li>
                        <div class="px-6 mt-6 text-xs font-semibold text-secondary uppercase">
                            Daftar Pengajuan
                        </div>
                    </li>
                    <li>
                        <a href="/admin"
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-tertiary hover:text-white">
                            <span>Menu Daftar Pengaduan</span>
                        </a>
                    </li>
                    <li>
                        <div class="px-6 mt-6 text-xs font-semibold text-secondary uppercase">
                            Daftar Pegawai
                        </div>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-tertiary hover:text-white">
                            <span>Data Daftar Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a href="#"
                            class="flex items-center px-6 py-2 space-x-4 text-secondary hover:bg-tertiary hover:text-white">
                            <span>Input Data Pegawai</span>
                        </a>
                    </li>
                @endif
            </ul>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
            this.closest('form').submit();"
                    class="text-secondary rounded-lg pl-3 hover:text-white hover:bg-tertiary">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </nav>
    </div>
</div>
