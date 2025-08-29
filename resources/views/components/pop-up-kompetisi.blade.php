@props([ 
    'title', 
    'message', 
    'confirmText',
    'color' => 'red' 
])

<div>
    <div 
        x-show="showConfirm"
        x-transition.opacity
        x-cloak
        class="fixed inset-0 z-50 flex items-center justify-center backdrop-blur-sm"
    >
        <div 
            class="bg-white p-6 rounded-lg shadow-xl w-80"
            x-on:click.outside="showConfirm = false"
        >
            <h2 class="text-lg font-semibold mb-2">{{ $title }}</h2>
            <p class="mb-16">{{ $message }}</p>
            <div class="flex justify-end gap-3">
                <button
                    x-on:click="showConfirm = false"
                    class="bg-gray-600 text-white px-4 py-1 rounded hover:bg-gray-800 cursor-pointer">
                    Batal
                </button>

                <button 
                    class="text-white px-4 py-1 rounded cursor-pointer
                    {{ $color === 'red' ? 'bg-red-600 hover:bg-red-700' : 'bg-[#029161] hover:bg-[#056444]' }}"
                    @click="
                        if(pendingUrl){
                            window.location.href = pendingUrl;
                        }
                        open = false
                    "
                >
                    {{ $confirmText }}
                </button>
            </div>
        </div>
    </div>
</div>