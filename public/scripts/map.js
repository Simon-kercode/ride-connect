let map = L.map('map').setView([46.6035, 1.888334], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

// Leaflet Draw configuration
let drawnItems = new L.FeatureGroup();
map.addLayer(drawnItems);

let drawControl = new L.Control.Draw({
    edit: {
        featureGroup: drawnItems
    },
    draw: {
        polygon: false,
        polyline: false,
        rectangle: false,
        circle: false,
        marker: true
    }
});
map.addControl(drawControl);

let startPointMarker = null;
let routeLayer = null;

// update start point position when user change the start point value
document.getElementById('startPoint').addEventListener('change', function(){
    updateStartPoint();
});

// draw itinerary
map.on('draw:created', function (e) {
    let layer = e.layer;
    drawnItems.addLayer(layer);
    createRoute();
});

// function to draw itinerary between each marker and add it on the map.
function createRoute() {
     // Get markers coordinates
    let waypoints = drawnItems.getLayers().map(layer => layer.getLatLng());
    console.log(waypoints);
    
    if (startPointMarker !== null) {
        waypoints.unshift(startPointMarker._latlng);
    }
    console.log(waypoints);

    if (waypoints.length >= 2) {
        // Use OpenRouteService to get the route
        fetch(`https://api.openrouteservice.org/v2/directions/driving-car/geojson`, {
            method: 'POST',
            headers: {
                'Authorization': '5b3ce3597851110001cf62488dbcf842567c4270aac1d8f77efc6c88',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                "coordinates": waypoints.map(waypoint => [waypoint.lng, waypoint.lat]),
                "format": "geojson",
                "instructions_format": "text",
                "language": "fr",
                "units": "km"
            }),
        })
        .then(response => response.json())
        .then(data => {
            if (routeLayer !== null) {
                map.removeLayer(routeLayer);
            }

            routeLayer = L.geoJSON(data).addTo(map);

            // let route = data.features[0].properties;
            // let distance = route.summary.distance //km;
            // let duration = route.summary.duration/60 //minutes;

            // console.log(route);
            // console.log(distance);
            // console.log(duration);

            // displayInfos(waypoints, distance, duration);
            // displayInstructions(route);
        })
        .catch(error => console.error('Erreur lors de la requête OpenRouteService:', error));
    }
}

function updateStartPoint() {
    // get the starting point
    let startPoint = document.getElementById('startPoint').value;

    // check if the starting point is not empty
    if (startPoint !== "") {
        // clear previous startPoint marker
        if (startPointMarker !== null) {
            map.removeLayer(startPointMarker);
        }

        // Request nominatim API with the town name
        let url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + encodeURIComponent(startPoint);

        // Fetch town coordinates
        fetch(url)
            .then(response => response.json())
            .then(data => {
                let lat = data[0].lat;
                let lon = data[0].lon;

                // Add new startPoint marker to the map
                startPointMarker = L.marker([lat, lon]).addTo(map);

                // Set the view of the map to the startPoint
                map.setView([lat, lon], 9);
                createRoute();
            })
            .catch(error => {
                console.error('Erreur lors de la récupération des coordonnées de la ville:', error);
            });
    }
}
