@props(['id', 'name', 'value', 'label', 'checked' => false])

<label for="{{ $id }}" class="flex items-center text-sm text-gray-300 cursor-pointer group">
    <input 
        type="checkbox" 
        id="{{ $id }}" 
        name="{{ $name }}" 
        value="{{ $value }}" 
        class="peer sr-only"
        @if($checked) checked @endif
    >

    {{-- A div que cria o visual customizado --}}
    <div class="
        w-5 h-5 rounded-md bg-emerald-900 border-2 border-emerald-600 
        transition-all duration-300 ease-in-out 
        group-hover:border-lime-400
        
        {{-- CLASSE DE SOMBRA ADICIONADA AQUI --}}
        hover:shadow-[0_0_15px_rgba(26,125,74,1)]

        peer-checked:bg-gradient-to-br from-green-500 to-emerald-700 
        peer-checked:border-transparent peer-checked:rotate-12 
        after:content-[''] after:absolute after:top-1/2 after:left-1/2 
        after:-translate-x-1/2 after:-translate-y-1/2 
        after:w-3 after:h-3 after:opacity-0 
        after:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0IiBmaWxsPSJub25lIiBzdHJva2U9IiNmZmZmZmYiIHN0cm9rZS13aWR0aD0iMyIgc3Ryb2tlLWxpbmVjYXA9InJvdW5kIiBzdHJva2UtbGluZWpvaW49InJvdW5kIj48cG9seWxpbmUgcG9pbnRzPSIyMCA2IDkgMTcgNCAxMiI+PC9wb2x5bGluZT48L3N2Zz4=')] 
        after:bg-contain after:bg-no-repeat 
        peer-checked:after:opacity-100 after:transition-opacity after:duration-300
    ">
    </div>

    <span class="ml-3">{{ $label }}</span>
</label>
