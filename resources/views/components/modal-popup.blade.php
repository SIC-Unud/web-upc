<div>
    @props([
    'id',
    'title',
    'message',
    'type' => 'accept', // default: accept | alternatif: reject
    'confirmFunction',
    'cancelFunction'
])

    <div id="{{ $id }}" class="fixed inset-0 flex items-center justify-center w-screen h-screen backdrop-blur-sm z-50">
        <div class="bg-white p-6 rounded-lg shadow-xl w-90">
            <h2 class="text-lg font-semibold mb-4">{{ $title }}</h2>
            <p class="mb-4">{{ $message }}</p>

            @if($type === 'reject')
                <textarea id="reject-note" class="w-full border rounded p-2 mb-6 resize-none" rows="3" placeholder="Ketik catatan untuk user... *"></textarea>
            @endif

            <div class="flex justify-end gap-4">
                <button onclick="{{ $cancelFunction }}" class="bg-gray-700 text-white px-6 py-1 rounded hover:bg-gray-800">Batal</button>
                <button onclick="{{ $confirmFunction }}"
                    class="{{ $type === 'reject' ? 'bg-red-600 hover:bg-red-700' : 'bg-[#029161] hover:bg-green-700' }} text-white px-6 py-1 rounded">
                    Ya
                </button>
            </div>
        </div>
    </div>
</div>