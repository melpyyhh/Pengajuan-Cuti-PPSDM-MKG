
    <!-- Tombol Lonceng (Notification Button) -->
    <div class="fixed" style="top: 70px; right: 20px;">
        <button wire:click="toggleDropdown"
            class="p-3 text-white rounded-full shadow-lg bg-primary hover:bg-tertiary focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
            💬 Notif
        </button>
    </div>
       

    @if($showDropdown)
        <div class="absolute right-0 mt-2 w-64 bg-white border rounded shadow-lg z-50">
            <ul>
                @forelse($notifications as $notification)
                    <li class="p-4 border-b {{ $notification['read'] ? 'text-gray-400' : 'text-gray-800' }}">
                        {{ $notification['message'] }}
                    </li>
                @empty
                    <li class="p-4 text-gray-500">Tidak ada notifikasi.</li>
                @endforelse
            </ul>
            <div class="p-2 text-center">
                <button class="text-sm text-blue-500 hover:underline" wire:click="markAsRead">Tandai semua sebagai sudah dibaca</button>
            </div>
        </div>
    @endif
