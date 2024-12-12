<div class="flex h-full bg-gray-100">
    <!-- Sidebar -->
    <div class="w-64 bg-primary border-r border-gray-200 flex flex-col min-h-screen overflow-x-hidden">
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
        <nav class="mt-6 flex-1 overflow-y-auto overflow-x-hidden">
            <ul class="space-y-2">
                <!-- Menu Pengaju -->
                @if (Auth::user()->hasRole('pengaju'))
                <li>
                    <div class="px-6 text-lg font-semibold text-secondary uppercase">
                        Menu Pengaju
                    </div>
                    <div class="border-t border-secondary mx-5 my-2"></div>
                </li>
                <li>
                    <a href="/pengaju"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                        {{ request()->is('pengaju') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
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
                    <div class="px-6 mt-6 text-xs font-semibold text-secondary uppercase">
                        Menu Penyetuju
                    </div>
                </li>
                <li>
                    <a href="/penyetuju"
                        class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors
                        {{ request()->is('penyetuju') || request()->is('penyetuju/penyetuju-detail') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                        <span>Daftar Ajuan Cuti Pegawai</span>
                    </a>
                </li>

                <li>
                    <a href="#"
                        class="flex items-center px-6 py-2 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white rounded-lg">
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
                    <div class="px-6 mt-6 text-xs font-semibold text-secondary uppercase">
                        Daftar Pengajuan
                    </div>
                </li>
                <a href="/admin"
                    class="flex items-center px-3 py-1 mx-6 space-x-4 pl-8 text-secondary hover:bg-tertiary hover:text-white transition-colors 
                        {{ request()->is('admin') ? 'bg-tertiary text-white font-semibold rounded-lg' : 'rounded-lg hover:shadow' }}">
                    <span>Menu Daftar Pengajuan</span>
                </a>
                <li>
                    <div class="px-6 mt-6 text-xs font-semibold text-secondary uppercase">
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
                    class="flex items-center text-secondary pl-3 mt-4 uppercase hover:bg-tertiary hover:text-white transition-colors tracking-wider font-bold">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </nav>
    </div>
</div>