@php
    $location = $getRecord()->location;
@endphp

@if($location)
    <iframe
        width="100%"
        height="400"
        style="border:0"
        loading="lazy"
        src="https://www.google.com/maps?q={{ $location->lat }},{{ $location->lng }}&hl=es&z=16&output=embed">
    </iframe>

    <div class="mt-2 text-sm text-gray-600">
        {{ $location->address }}
    </div>
@endif
