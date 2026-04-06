<x-filament-widgets::widget>
    <x-filament::section heading="Mapa de Reportes" icon="heroicon-o-map" icon-color="primary">
        <div 
            x-data="{
                map: null,
                reports: @js($reports),
                isLoading: true,
                error: null,
                
                // Mapa de colores segun clasificación
                colors: {
                    'minor': '#3b82f6', // Azul (Leve)
                    'major': '#f59e0b', // Ámbar (Grave)
                    'severe': '#ef4444' // Rojo (Muy Grave)
                },

                createMarkerIcon(color) {
                    return L.divIcon({
                        html: `
                            <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='${color}' class='w-8 h-8 shadow-sm'>
                                <path d='M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z'/>
                            </svg>
                        `,
                        className: 'custom-div-icon',
                        iconSize: [32, 32],
                        iconAnchor: [16, 32],
                        popupAnchor: [0, -32]
                    });
                },

                async init() {
                    let attempts = 0;
                    while (typeof L === 'undefined' && attempts < 100) {
                        await new Promise(r => setTimeout(r, 100));
                        attempts++;
                    }
                    if (typeof L === 'undefined') {
                        this.error = 'No se pudo cargar la librería de mapas.';
                        this.isLoading = false;
                        return;
                    }
                    this.render();
                },

                render() {
                    try {
                        if (this.map) return;
                        this.map = L.map(this.$refs.mapContainer).setView([-34.6037, -58.3816], 10);
                        
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap'
                        }).addTo(this.map);

                        if (this.reports.length > 0) {
                            const markerGroup = L.featureGroup();
                            this.reports.forEach(report => {
                                const color = this.colors[report.classification] || this.colors.minor;
                                L.marker([report.lat, report.lng], {
                                    icon: this.createMarkerIcon(color)
                                })
                                .bindPopup(`
                                    <div class='p-1'>
                                        <b class='text-sm'>${report.violation_type}</b><br>
                                        <span class='text-xs text-gray-400'>${report.address}</span>
                                        <hr class='my-1 border-gray-100'>
                                        <span class='px-2 py-0.5 rounded text-[10px] font-bold text-white' style='background-color: ${color}'>
                                            ${report.classification === 'severe' ? 'Muy Grave' : (report.classification === 'major' ? 'Grave' : 'Leve')}
                                        </span>
                                    </div>
                                `)
                                .addTo(markerGroup);
                            });
                            markerGroup.addTo(this.map);
                            this.map.fitBounds(markerGroup.getBounds().pad(0.1));
                        }
                        
                        this.isLoading = false;
                        setTimeout(() => this.map.invalidateSize(), 500);
                    } catch (e) {
                        this.error = 'Error: ' + e.message;
                        this.isLoading = false;
                    }
                }
            }"
            class="w-full relative"
            style="min-height: 500px"
        >
            <style>
                .custom-div-icon { background: none; border: none; }
            </style>

            <div x-ref="mapContainer" style="height: 500px; width: 100%;" class="bg-gray-100 dark:bg-gray-800 rounded-xl overflow-hidden shadow-inner border border-gray-200 dark:border-gray-700"></div>

            <template x-if="isLoading">
                <div class="absolute inset-0 z-50 flex items-center justify-center bg-white/60 dark:bg-gray-900/60 rounded-xl">
                    <x-filament::loading-indicator class="h-10 w-10 text-primary-600" />
                </div>
            </template>

            <template x-if="error">
                <div class="absolute inset-0 z-50 flex items-center justify-center bg-red-50/90 dark:bg-red-950/20 rounded-xl p-4 text-center">
                    <p class="text-red-700 dark:text-red-400 font-medium" x-text="error"></p>
                </div>
            </template>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
