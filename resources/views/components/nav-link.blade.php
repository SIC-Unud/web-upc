@props(['active' => false])

<a {{ $attributes }}
   class="{{ $active ? 'bg-blue-500 text-white' : 'bg-white text-black  hover:bg-[#D9D9D9]' }} items-center flex cursor-pointer w-full py-2 rounded-md gap-4 md:mb-1 lg:mb-3 lg:gap-5 text-sm md:text-[10px] lg:text-base">
   {{ $slot }}
</a>