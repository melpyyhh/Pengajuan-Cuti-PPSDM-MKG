{{-- Header --}}
<div>
    <h1 class="py-2 text-4xl font-bold tracking-wider text-gray-800">
        {{ $pages[$currentPage]['heading'] }}
    </h1>
    <p class="mb-4">{{ $pages[$currentPage]['subheading'] }}</p>

    <div class="p-6 bg-[#F4F7FE] shadow-lg rounded-lg">
        <!-- Form Cuti -->
        <form wire:submit.prevent="submitPenyetuju">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <!-- Bagian Kiri -->
                <div class="space-y-6">
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

                    <!-- Dokumen Pendukung -->
                    <div>
                        @if ($dokumenPath != null)
                            <label for="dokumen" class="block mb-2 tracking-wider text-gray-800 text-md">Dokumen
                                Pendukung:</label>
                            <div class="flex items-center space-x-4">
                                <!-- Tombol Preview -->
                                <a href="{{ Storage::url($dokumenPath) }}" target="_blank"
                                    class="px-4 py-2 text-white bg-blue-500 hover:bg-blue-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Preview
                                </a>
                                <!-- Tombol Download -->
                                <button type="button" onclick="downloadDokumen('{{ $dokumenPath }}')"
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Download Dokumen
                                </button>
                        @endif
                    </div>
                </div>

            </div>

            <!-- Bagian Kanan -->
            <div>
                <label for="alasan" class="block mb-2 tracking-wider text-gray-800 text-md">Alasan Cuti:</label>
                <textarea id="alasan" wire:model="alasan" rows="10"
                    class="mt-1 block w-full rounded-lg focus:border-blue-500 focus:ring-blue-500 border border-[#0032CC]"
                    placeholder="Jelaskan alasan cuti Anda" disabled></textarea>
            </div>
    </div>

    <!-- Button -->
    @if (strtolower($statusAjuan) == 'diproses')
        <div class="flex justify-center gap-4 mt-6">
            <button type="button" wire:click="submitPenyetuju"
                class="px-4 py-2 text-white transition-colors bg-green-500 shadow shadow-md rounded-3xl hover:bg-orange-300">Setuju
            </button>
            <button type="button" wire:click="openModal"
                class="px-4 py-2 text-white transition-colors bg-red-500 shadow shadow-md rounded-3xl hover:bg-orange-300">Tolak
            </button>
            <button type="button" wire:navigate href="/penyetuju"
                class="px-4 py-2 text-white transition-colors shadow shadow-md bg-tertiary rounded-3xl hover:bg-orange-300">
                Kembali
            </button>
        </div>
    @else
        <div class="flex justify-center gap-4 mt-6">
            <button type="button" onclick="window.location.href='/penyetuju'"
                class="px-4 py-2 text-white transition-colors shadow shadow-md bg-tertiary rounded-3xl hover:bg-orange-300">
                Kembali
            </button>
        </div>
    @endif
    </form>
</div>

<!-- Modal -->
@if ($isOpen)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75">
        <div class="bg-white p-8 rounded-xl border-2 border-[#0032CC] shadow-lg w-full md:w-1/2 lg:w-1/3">
            <h3 class="mb-4 text-2xl font-semibold text-center">Berikan Alasan/Feedback</h3>
            <textarea wire:model="feedback" class="w-full p-2 mt-2 border rounded-lg" rows="6"
                placeholder="Tuliskan Alasan Anda disini..."></textarea>
            <div class="flex justify-end gap-4 mt-4">
                <button wire:click="closeModal"
                    class="px-4 py-2 text-white bg-red-500 rounded-xl bg-tertiary">Tutup</button>
                <button wire:click="submitTolak"
                    class="px-4 py-2 text-white bg-blue-500 rounded-xl bg-tertiary">Tolak</button>
            </div>
        </div>
    </div>
@endif
</div>

<script>
    function downloadDokumen(dokumenPath) {
        const url = `/download-dokumen/${dokumenPath}`;
        window.open(url, '_blank');
    }
</script>
