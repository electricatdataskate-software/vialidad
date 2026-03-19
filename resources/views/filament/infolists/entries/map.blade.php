@php
    $location = $getRecord()->location;
@endphp

@if($location && $location->lat && $location->lng)
    <div class="rounded-xl overflow-hidden border border-gray-200 dark:border-gray-700 shadow-sm" wire:key="map-{{ $location->id }}">
        <iframe
            width="100%"
            height="400"
            style="border:0"
            loading="lazy"
            src="https://maps.google.com/maps?q={{ $location->lat }},{{ $location->lng }}&t=&z=16&ie=UTF8&iwloc=B&output=embed">
        </iframe>
        <div class="p-3 bg-gray-50 dark:bg-gray-800 text-sm text-gray-600 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 italic">
            📍 {{ $location->address }}
        </div>
    </div>
@else
    <div class="flex flex-col items-center justify-center p-12 bg-gray-100 dark:bg-gray-900 rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-700 text-gray-500">
        <span class="text-4xl mb-2">📍</span>
        <p class="font-medium">No hay coordenadas registradas para esta ubicación</p>
        <p class="text-xs">Asegúrese de seleccionar una ubicación del mapa al crear el reporte.</p>
    </div>
@endif
