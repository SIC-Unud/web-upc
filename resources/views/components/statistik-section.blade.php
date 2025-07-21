<div class="text-center bg-white shadow-lg p-3 md:p-5 rounded-lg">
   <h1 class="text-lg md:text-2xl font-extrabold mb-2 md:mb-4">{{ $jumlah }}</h1>
   <div {{ $attributes->merge(['class' => 'flex items-center gap-0.5 justify-center']) }}>
      {{ $icon }}
      <h1 class="text-sm md:text-lg font-bold">{{ $slot }}</h1>
   </div>
</div>