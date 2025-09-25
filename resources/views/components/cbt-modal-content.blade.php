<div class="bg-white p-6 rounded-lg shadow-xl w-90">
   <div class="mb-10">
      <h1 {{ $attributes->merge(['class' => 'font-bold mb-3']) }}>{{ $title }}</h1>
      <p class="text-justify">{{ $description }}</p>
   </div>
   <div class="flex justify-end">
      <button class="bg-[#007BFF] text-white py-1 px-3 rounded-sm cursor-pointer">Mengerti</button>
   </div>
</div>
