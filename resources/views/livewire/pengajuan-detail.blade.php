<div>
    <h1 class="py-2 text-4xl font-semibold leading-tight text-gray-800">
        {{ $pages[$currentPage]['heading'] }}
    </h1>
    <p class="mb-4">{{ $pages[$currentPage]['subheading'] }}</p>

    <div class="p-6 bg-[#F4F7FE] shadow-lg rounded-lg">
        <!-- Form Cuti -->
        <form wire:submit.prevent="submitPenyetuju">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Bagian Kiri -->
                <div class="space-y-6">
                    <!-- Jenis Cuti -->
                    <div>
                        <label for="jenis_cuti" class="block mb-2 tracking-wider text-gray-800 text-md">Jenis
                            Cuti:</label>
                        <input type="text" id="jenis_cuti" wire:model="jenisCuti"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>

                    <!-- Alasan Cuti -->
                    <div>
                        <label for="alasan" class="block mb-2 tracking-wider text-gray-800 text-md">Alasan
                            Cuti:</label>
                        <textarea id="alasan" wire:model="alasanCuti" rows="10"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]" disabled></textarea>
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block mb-2 tracking-wider text-gray-800 text-md">Tanggal
                            Mulai:</label>
                        <input type="text" id="tanggal_mulai" wire:model="tanggalMulai"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block mb-2 tracking-wider text-gray-800 text-md">Tanggal
                            Selesai:</label>
                        <input type="text" id="tanggal_selesai" wire:model="tanggalSelesai"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>
                </div>

                <!-- Bagian Kanan -->
                <div class="space-y-6">
                    <!-- Nomor Handphone -->
                    <div>
                        <label for="nomor_hp" class="block mb-2 tracking-wider text-gray-800 text-md">Nomor
                            Handphone:</label>
                        <input type="text" id="nomor_hp" wire:model="nomorHp"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>

                    <!-- Alamat Selama Cuti -->
                    <div>
                        <label for="alamat_cuti" class="block mb-2 tracking-wider text-gray-800 text-md">Alamat Selama
                            Cuti:</label>
                        <input type="text" id="alamat_cuti" wire:model="alamatCuti"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>
                </div>
            </div>

            <!-- Button -->
            <div class="flex justify-center gap-4 mt-6">
                <button type="button" wire:navigate href="/pengaju"
                    class="px-4 py-2 text-white transition-colors shadow shadow-md bg-tertiary rounded-3xl hover:bg-orange-300">Kembali</button>
                <button type="button" wire:click="#"
                    class="px-4 py-2 text-white transition-colors bg-red-500 shadow shadow-md rounded-3xl hover:bg-red-300">Batalkan</button>
                <button type="button" wire:click="#"
                    class="px-4 py-2 text-white transition-colors bg-green-500 shadow shadow-md rounded-3xl hover:bg-green-300">Cetak PDF</button>
            </div>
        </form>
    </div>
</div>
