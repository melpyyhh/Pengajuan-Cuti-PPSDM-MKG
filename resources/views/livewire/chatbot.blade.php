<div>
    <!-- Tombol Chatbot -->
    <div class="fixed bottom-5 right-5">
        <button wire:click="toggleModal"
            class="p-3 text-white rounded-full shadow-lg bg-primary hover:bg-tertiary focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
            💬 Chatbot
        </button>
    </div>

    <!-- Modal Chatbot -->
    @if ($showModal)
        <div class="absolute z-50 flex flex-col bg-white rounded-lg shadow-lg bottom-20 right-5 w-80">
            <!-- Header -->
            <div class="flex items-center justify-between px-4 py-2 text-white rounded-t-lg bg-tertiary">
                <h2 class="font-bold">Ask PPSDM!</h2>
                <button wire:click="toggleModal" class="text-white hover:text-gray-200">
                    ✖
                </button>
            </div>

            <!-- Area Percakapan -->
            <div class="flex-1 p-4 overflow-y-auto bg-primary" style="max-height: 300px;">
                @foreach ($chats as $chat)
                    @if ($chat['sender'] === 'bot')
                        <!-- Pesan dari Bot -->
                        <div class="mb-2">
                            <p class="p-2 text-blue-800 bg-blue-100 rounded-lg max-w-max">
                                <strong>Bot:</strong> {{ $chat['message'] }}
                            </p>
                        </div>
                    @else
                        <!-- Pesan dari User -->
                        <div class="mb-2 text-right">
                            <p class="p-2 ml-auto text-orange-800 bg-green-100 rounded-lg max-w-max">
                                <strong>Anda:</strong> {{ $chat['message'] }}
                            </p>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Input Pesan -->
            <div class="flex items-center px-4 py-2 border-t">
                <textarea wire:model.defer="question" rows="1" @keydown.enter.prevent="$wire.ask()"
                    class="flex-1 p-2 text-sm border border-[#0032CC] rounded-lg resize-none focus:ring-orange-500 focus:border-orange-500"
                    placeholder="Tulis pesan Anda..."></textarea>
                <button wire:click="ask"
                    class="p-2 ml-2 text-white rounded-full bg-tertiary hover:bg-orange-800 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50">
                    ➤
                </button>
            </div>
        </div>
    @endif
</div>
