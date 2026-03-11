<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 bg-red-600/80 hover:bg-red-700 text-white py-3 px-6 rounded-lg border border-red-700/50 hover:border-red-500 transition-all duration-300 hover:-translate-y-1 group disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>