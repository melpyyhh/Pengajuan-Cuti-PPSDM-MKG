<!-- Tombol Lonceng (Notification Button) -->
<div>
    <button wire:click="toggleDropdown"
        class="p-3 text-white rounded-full shadow-lg bg-primary hover:bg-tertiary focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
        <svg viewBox="-1.5 0 20 20" version="1.1" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" fill="#ffffff" stroke="#ffffff" width="24" height="24">
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <title>notification_bell [#1397]</title>
                <desc>Created with Sketch.</desc>
                <defs></defs>
                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <g id="Dribbble-Light-Preview" transform="translate(-181.000000, -720.000000)" fill="#ffffff">
                        <g id="icons" transform="translate(56.000000, 160.000000)">
                            <path d="M137.75,574 L129.25,574 L129.25,568 C129.25,565.334 131.375,564 133.498937,564
                                L133.501063,564 C135.625,564 137.75,565.334 137.75,568 L137.75,574 Z M134.5625,577
                                C134.5625,577.552 134.0865,578 133.5,578 C132.9135,578 132.4375,577.552 132.4375,577
                                L132.4375,576 L134.5625,576 L134.5625,577 Z M140.9375,574 C140.351,574 139.875,573.552
                                139.875,573 L139.875,568 C139.875,564.447 137.359,562.475 134.5625,562.079 L134.5625,561
                                C134.5625,560.448 134.0865,560 133.5,560 C132.9135,560 132.4375,560.448 132.4375,561
                                L132.4375,562.079 C129.641,562.475 127.125,564.447 127.125,568 L127.125,573 C127.125,573.552
                                126.649,574 126.0625,574 C125.476,574 125,574.448 125,575 C125,575.552 125.476,576 126.0625,576
                                L130.3125,576 L130.3125,577 C130.3125,578.657 131.739438,580 133.5,580 C135.260563,580
                                136.6875,578.657 136.6875,577 L136.6875,576 L140.9375,576 C141.524,576 142,575.552 142,575
                                C142,574.448 141.524,574 140.9375,574 L140.9375,574 Z" id="notification_bell-[#1397]">
                            </path>
                        </g>
                    </g>
                </g>
            </g>
        </svg>
    </button>

    @if ($showDropdown)
        <div class="absolute right-0 z-50 w-64 mt-2 bg-white border rounded shadow-lg">
            <ul>
                @forelse($notifications as $notification)
                    <li class="p-4 border-b {{ $notification['read'] ? 'text-gray-400' : 'text-gray-800' }}">
                        {{ $notification['message'] }}
                    </li>
                @empty
                    <li class="p-4 text-gray-500">Tidak ada notifikasi.</li>
                @endforelse
            </ul>
        </div>
    @endif
</div>
