<div class="flex h-full bg-gray-100">
    <!-- Sidebar -->
    <div class="flex flex-col w-64 min-h-screen overflow-x-hidden border-r border-gray-200 bg-primary">
        <div class="px-6 py-4">
            <!-- User Info -->
            <div class="flex items-center space-x-4">
                <div class="w-12 h-12 bg-gray-300 rounded-full"></div>
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
        <nav class="flex-1 mt-6 overflow-x-hidden overflow-y-auto">
            <ul class="space-y-2">
                <!-- Menu Pengaju -->
                @if (Auth::user()->hasRole('pengaju'))
                <li>
                    <div class="px-6 text-lg font-semibold uppercase text-secondary">
                        Menu Pengaju
                    </div>
                    <div class="mx-5 my-2 border-t border-secondary"></div>
                </li>
                <li>
                    <a href="/pengaju"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                        {{ request()->is('pengaju') || request()->is('pengajuan/pengajuan-detail/')? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Riwayat Cuti</span>
                    </a>
                </li>
                <li>
                    <a href="/pengajuan-form"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                    {{ request()->is('pengajuan-form') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Pengajuan</span>
                    </a>
                </li>
                <a href="{{ route('pengaju.pengaduan.form') }}"
                    class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                {{ request()->is('pengaju/pengaduan-form') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                    <span>Ajukan Pengaduan ke Admin</span>
                </a>
                @endif

                <!-- Menu Penyetuju -->
                @if (Auth::user()->hasRole('penyetuju'))
                <li>
                    <div class="px-6 mt-6 text-xs font-semibold uppercase text-secondary">
                        Menu Penyetuju
                    </div>
                </li>
                <li>
                    <a href="/penyetuju"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                        {{ request()->is('penyetuju') || request()->is('penyetuju/penyetuju-detail/') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Daftar Ajuan Cuti Pegawai</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center px-6 py-2 pl-8 mx-6 space-x-4 rounded-lg text-secondary hover:bg-tertiary hover:text-white">
                        <span>Dashboard Cuti Pegawai</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('penyetuju.pengaduan.form') }}"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                    {{ request()->is('penyetuju/pengaduan-form') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Ajukan Pengaduan ke Admin</span>
                    </a>
                </li>
                @endif

                {{-- Menu Admin --}}
                @if (Auth::user()->hasRole('admin'))
                <li>
                    <div class="px-6 mt-6 text-xs font-semibold uppercase text-secondary">
                        Daftar Pengajuan
                    </div>
                </li>
                <a href="/admin"
                    class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                        {{ request()->is('admin') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                    <span>Menu Daftar Pengajuan</span>
                </a>
                <li>
                    <div class="px-6 mt-6 text-xs font-semibold uppercase text-secondary">
                        Daftar Pegawai
                    </div>
                </li>
                <li>
                    <a href="/daftar-pegawai"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                    {{ request()->is('daftar-pegawai') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Data Daftar Pegawai</span>
                    </a>
                </li>
                <li>
                    <a href="/input-pegawai"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                    {{ request()->is('input-pegawai') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
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
                    class="flex items-center pl-3 mt-4 font-bold tracking-wider uppercase transition-colors text-secondary hover:bg-tertiary hover:text-white">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </nav>
    </div>
</div>
