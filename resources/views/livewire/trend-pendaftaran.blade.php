<div 
    x-data="trendChartComponent"
    x-init="$nextTick(() => initChart(@js($labels), @js($data)))"
    wire:ignore
    class="w-full bg-white shadow-lg p-3 md:p-5 rounded-lg"
    style="min-height: 400px;"
>
    <div class="flex justify-between mb-2 ml-2 md:mb-4 md:ml-4 items-center">
        <h1 class="text-lg md:text-xl lg:text-2xl font-extrabold">Trend Pendaftar</h1>
        <select class="bg-[#D9D9D9] p-1 rounded text-xs md:text-base" wire:change="onYearChange($event.target.value)">
            @foreach ($availableYears as $year)
                <option value="{{ $year }}">{{ $year }}</option>
            @endforeach
        </select>
    </div>

    <canvas id="TrendPendaftar" class="w-full max-h-80"></canvas>
</div>
