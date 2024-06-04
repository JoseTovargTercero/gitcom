
var control = L.Routing.control(L.extend(window.lrmConfig, {
	waypoints: [
		L.latLng(5.665783, -67.588792),
		L.latLng(5.652947, -67.609738)
	],
    language: 'es',
	geocoder: L.Control.Geocoder.nominatim(),
    routeWhileDragging: true,
    reverseWaypoints: true,
    showAlternatives: false,
    altLineOptions: {
        styles: [
            {color: 'black', opacity: 0.15, weight: 9},
            {color: 'white', opacity: 0.8, weight: 6},
            {color: 'blue', opacity: 0.5, weight: 2}
        ]
    }
})).addTo(map);
