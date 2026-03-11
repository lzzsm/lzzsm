<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center justify-center gap-2 bg-slate-800/50 hover:bg-slate-700/60 text-gray-200 py-3 px-6 rounded-lg border border-emerald-600/30 hover:border-lime-400/50 transition-all duration-300 hover:-translate-y-1 group disabled:opacity-50 disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>