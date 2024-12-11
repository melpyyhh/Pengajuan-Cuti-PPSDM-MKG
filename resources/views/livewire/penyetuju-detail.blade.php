<div>
    <h1 class="py-2 font-semibold text-4xl text-gray-800 leading-tight">
        {{ $pages[$currentPage]['heading'] }}
    </h1>
    <p class="mb-4">{{ $pages[$currentPage]['subheading'] }}</p>

    <div class="p-6 bg-[#F4F7FE] shadow-lg rounded-lg">
        <!-- Form Cuti -->
        <form wire:submit.prevent="submitPenyetuju">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Bagian Kiri -->
                <div class="space-y-6">
                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-md tracking-wider text-gray-800 mb-2">Tanggal Mulai:</label>
                        <input type="date" id="tanggal_mulai" wire:model="tanggal_mulai"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block text-md tracking-wider text-gray-800 mb-2">Tanggal Selesai:</label>
                        <input type="date" id="tanggal_selesai" wire:model="tanggal_selesai"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>

                    <!-- Dokumen Pendukung -->
                    <div>
                        <label for="dokumen" class="block text-md tracking-wider text-gray-800 mb-2">Dokumen Pendukung:</label>
                        <input type="file" id="dokumen" wire:model="dokumen"
                            class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                            disabled>
                    </div>
                </div>

                <!-- Bagian Kanan -->
                <div>
                    <label for="alasan" class="block text-md tracking-wider text-gray-800 mb-2">Alasan Cuti:</label>
                    <textarea id="alasan" wire:model="alasan" rows="10"
                        class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                        placeholder="Jelaskan alasan cuti Anda" disabled></textarea>
                </div>
            </div>

            <!-- Button -->
            <div class="mt-6 flex justify-center gap-4">
                <button type="button" wire:click="setuju"
                    class="bg-tertiary shadow-md text-white py-2 px-4 rounded-3xl shadow hover:bg-orange-300 transition-colors">Setuju</button>
                <button type="button" wire:click="openModal"
                    class="bg-tertiary shadow-md text-white py-2 px-4 rounded-3xl shadow hover:bg-orange-300 transition-colors">Tolak</button>
            </div>
        </form>
    </div>

    <!-- Modal -->
    @if($isOpen)
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-xl border-2 border-[#0032CC] shadow-lg w-full md:w-1/2 lg:w-1/3">
            <h3 class="text-2xl font-semibold mb-4 text-center">Berikan Alasan/Feedback</h3>
            <textarea wire:model="modalAlasan" class="w-full border p-2 mt-2 rounded-lg" rows="6" placeholder="Tuliskan Alasan Anda disini..."></textarea>
            <div class="mt-4 flex justify-end gap-4">
                <button wire:click="closeModal" class="bg-red-500 text-white py-2 px-4 rounded-xl bg-tertiary">Tutup</button>
                <button wire:click="submitTolak" class="bg-blue-500 text-white py-2 px-4 rounded-xl bg-tertiary">Tolak</button>
            </div>
        </div>
    </div>
    @endif
</div>