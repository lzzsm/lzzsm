@extends('layouts.main')

@section('title', 'Detalhes: ' . $collectPoint->nome)

@section('content')
    <div class="bg-slate-900 text-gray-200 min-h-screen">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-16">

            <!-- Butão de Voltar -->
            <button onclick="window.history.back()"
                class="inline-flex items-center text-sm font-medium text-gray-400 hover:text-lime-300 transition-colors mb-6 group">
                <i data-lucide="arrow-left"
                    class="w-4 h-4 mr-2 transition-transform duration-300 group-hover:-translate-x-1"></i>
                Voltar
            </button>

            <!-- Cabeçalho -->
            <div class="max-w-5xl mx-auto mb-12">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-extrabold text-white tracking-tight">{{ $collectPoint->nome }}</h1>
                    <p class="mt-2 text-lg text-emerald-400">Ponto de Coleta Oficial Perseph</p>
                </div>
            </div>

            <!-- Conteúdo Principal -->
            <div
                class="max-w-5xl mx-auto bg-gray-800/50 rounded-2xl shadow-2xl shadow-black/20 border border-gray-700/50 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">

                    <!-- Coluna da Esquerda: Mapa Interativo -->
                    <div class="bg-gray-900/50 relative min-h-[400px]">
                        <div id="map" class="w-full h-full"></div>
                        <!-- Loading do Mapa -->
                        <div id="mapLoading" class="absolute inset-0 bg-gray-900/80 flex items-center justify-center z-10">
                            <div class="text-center">
                                <i data-lucide="map" class="w-8 h-8 text-lime-400 mx-auto mb-2 animate-pulse"></i>
                                <p class="text-lime-400 text-sm">Carregando mapa...</p>
                            </div>
                        </div>
                    </div>

                    <!-- Coluna da Direita: Informações -->
                    <div class="p-8 flex flex-col justify-center">
                        <h2 class="text-2xl font-bold text-white mb-6">Detalhes do Local</h2>

                        <div class="space-y-5">
                            <!-- Endereço -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <i data-lucide="map-pin" class="w-5 h-5 text-lime-400"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-300">Endereço Completo</h3>
                                    <p class="text-gray-400">{{ $collectPoint->rua }}, {{ $collectPoint->numero ?? 'S/N' }}
                                    </p>
                                    <p class="text-gray-400">{{ $collectPoint->cidade }}/{{ $collectPoint->estado }}</p>
                                </div>
                            </div>

                            <!-- CEP -->
                            <div class="flex items-start">
                                <div class="flex-shrink-0 mt-1">
                                    <i data-lucide="mailbox" class="w-5 h-5 text-lime-400"></i>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-semibold text-gray-300">CEP</h3>
                                    <p class="text-gray-400 font-mono">{{ $collectPoint->cep_formatado }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Botão Google Maps -->
                        <div class="mt-8 pt-6 border-t border-gray-700">
                            @php
                                $enderecoGoogleMaps = urlencode(
                                    "{$collectPoint->rua}, {$collectPoint->numero}, {$collectPoint->cidade}, {$collectPoint->estado}",
                                );
                            @endphp
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $enderecoGoogleMaps }}"
                                target="_blank" rel="noopener noreferrer"
                                class="group inline-flex items-center justify-center w-full text-center bg-emerald-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-emerald-700 transition-transform transform hover:scale-105 shadow-lg">
                                <i data-lucide="map-pinned" class="w-4 h-4 mr-2"></i>
                                Abrir no Google Maps
                                <i data-lucide="external-link" class="w-4 h-4 ml-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <style>
        #map {
            height: 400px;
            z-index: 1;
        }

        .leaflet-container {
            background: #1e293b !important;
        }
    </style>

    <script>
        // Endereço completo para geocoding
        const enderecoCompleto =
            "{{ $collectPoint->rua }}, {{ $collectPoint->numero ?? '' }}, {{ $collectPoint->cidade }}, {{ $collectPoint->estado }}";

        // Inicializar mapa quando a página carregar
        document.addEventListener('DOMContentLoaded', function() {
            inicializarMapaPorEndereco();
        });

        async function inicializarMapaPorEndereco() {
            try {
                // Fazer geocoding do endereço para obter coordenadas
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(enderecoCompleto)}&limit=1`
                );

                const data = await response.json();

                if (data && data.length > 0) {
                    const local = data[0];
                    const lat = parseFloat(local.lat);
                    const lon = parseFloat(local.lon);

                    // Criar mapa com as coordenadas obtidas
                    const map = L.map('map').setView([lat, lon], 16);

                    // Adicionar tile layer (mapa escuro)
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                        subdomains: 'abcd',
                        maxZoom: 20
                    }).addTo(map);

                    // Adicionar marcador simples
                    L.marker([lat, lon]).addTo(map);

                    // Esconder loading
                    document.getElementById('mapLoading').style.display = 'none';

                } else {
                    throw new Error('Endereço não encontrado');
                }

            } catch (error) {
                console.error('Erro ao carregar mapa:', error);
                document.getElementById('mapLoading').innerHTML = `
                    <div class="text-center">
                        <i data-lucide="map-pin-off" class="w-8 h-8 text-red-400 mx-auto mb-2"></i>
                        <p class="text-red-400 text-sm">Erro ao carregar mapa</p>
                    </div>
                `;
            }
        }
    </script>
@endsection
