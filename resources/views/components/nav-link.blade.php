@props(['active' => false])

<a {{ $attributes }}
   class="{{ $active ? 'bg-blue-500 text-white' : 'bg-white text-black  hover:bg-[#D9D9D9]' }} items-center flex gap-5 cursor-pointer w-full pl-5 py-2 rounded-md mb-3">
   {{ $slot }}
</a>
