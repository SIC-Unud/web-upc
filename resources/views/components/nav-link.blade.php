@props(['active' => false])

<a {{ $attributes }}
   class="{{ $active ? 'bg-blue-500 text-white' : 'bg-white text-black  hover:bg-[#D9D9D9]' }} items-center flex cursor-pointer w-full pl-5 py-2 rounded-md text-[10px] gap-4 mb-1 lg:mb-3 lg:gap-5 lg:text-base">
   {{ $slot }}
</a>
