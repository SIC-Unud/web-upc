@props(['isMissed' => false])

<div class="w-full flex flex-col pl-2">
   <img src="/assets/competition/kompetisi.png" class="max-w-full" alt="">
   <div class="bg-white grow rounded-b-3xl flex flex-col shadow-xl">
      <div class="flex flex-col grow p-2 md:p-5 pt-2">
         <h1 class="text-[8px] md:text-xs lg:text-base font-semibold">
            {{ $title }}
         </h1>
         <p class="text-[5px] md:text-[8px] lg:text-[10px]">{{ $date }}</p>
      </div>
      <h1
         class="{{ $isMissed ? 'text-[#FF0606]' : 'text-[#029161]' }} text-end mx-4 lg:mx-7 text-[6px] md:text-[10px] lg:text-xs font-semibold py-2 lg:py-5">
         {{ $status }}</h1>
   </div>
</div>
