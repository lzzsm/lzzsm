@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-slate-800/50 border border-emerald-600/30 text-gray-100 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-colors disabled:opacity-50 disabled:cursor-not-allowed']) !!}>