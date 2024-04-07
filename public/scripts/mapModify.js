let map = L.map('mapModify').setView([46.6035, 1.888334], 6);

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

// Event listeners :
// marker added
map.on('draw:created', function (e) {
    let layer = e.layer;
    drawnItems.addLayer(layer);
    updateWaypoints();
});
// marker moved
map.on('draw:edited', function (e) {
    updateWaypoints();
});
// marker deleted
map.on('draw:deleted', function (e) {
    updateWaypoints();
});

document.querySelector('#modifyForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    let pointsInfosInput = document.querySelector('#pointsInfosModify');
    let routeInfosInput = document.querySelector('#routeInfosModify');
    let waypointsInput = document.querySelector('#waypointsModify');

    // getting infos points
    let pointsInfos = await getPointsInfos(waypoints);
        console.log(pointsInfos);
    
    pointsInfosInput.value = JSON.stringify(pointsInfos);
    routeInfosInput.value = JSON.stringify(routeInfos);
    waypointsInput.value = JSON.stringify(waypoints);
    
    document.getElementById('modifyForm').submit();
})
let waypoints = [];
let routeLayer = null;
let routeInfos = null;
let startPointMarker = null;

document.getElementById('startPointModify').addEventListener('change', function(){
    updateStartPoint();
});

function updateWaypoints() {
    waypoints = drawnItems.getLayers().map(layer => layer.getLatLng());
    createRoute(waypoints);
}

function createRoute(waypoints) {
    if (waypoints.length < 2 && routeLayer !== null) {
        map.removeLayer(routeLayer);
    }

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
                if(routeLayer !== null) {
                    map.removeLayer(routeLayer);
                }

                routeLayer = L.geoJSON(data).addTo(map);
                map.fitBounds(routeLayer.getBounds());

                let route = data.features[0].properties;

                routeInfos = {
                    distance : route.summary.distance, //km
                    duration : route.summary.duration/60 //minutes
                };

            })
            .catch(error => console.error(error));
 
    }
}

function displayInitial(initialWaypoints) {
    
    initialWaypoints.forEach(waypoint => {
        if (initialWaypoints.indexOf() === 0) {
            startPointMarker = L.marker(initialWaypoints[0].lat, initialWaypoints[0].lng);
            // drawnItems.addLayer(startPointMarker);
        }
        else {
            let marker = L.marker([waypoint.lat, waypoint.lng], {draggable: true});
            drawnItems.addLayer(marker);
        }
    })
    

    updateWaypoints();  
}

async function updateStartPoint() {
    // get the starting point
    let startPoint = document.getElementById('startPointModify').value;

    if (startPointMarker == null) {
    startPointMarker = L.marker([waypoints[0].lat, waypoints[0].lng]);
    }
    // check if the starting point is not empty
    if (startPoint !== "") {
        // clear previous startPoint marker
        if (startPointMarker !== null) {
            drawnItems.removeLayer(startPointMarker);
        }

        // Request nominatim API with the town name
        let url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + startPoint;

        // Fetch town coordinates
        await fetch(url)
            .then(response => response.json())
            .then(data => {
                let lat = data[0].lat;
                let lon = data[0].lon;

                // Add new startPoint marker to the map
                startPointMarker = L.marker([lat, lon], {draggable: true});
                // drawnItems.addLayer(startPointMarker);

                // Set the view of the map to the startPoint
                map.setView([lat, lon], 9);

                if (startPointMarker !== null && waypoints.length > 0) {
                    let newLatLng = startPointMarker.getLatLng();
                    waypoints[0].lat = newLatLng.lat;
                    waypoints[0].lng = newLatLng.lng;
                    createRoute(waypoints);
                }
                
            })
            .catch(error => {
                console.error(error);
            });
    }
}

// get city name, department and region of one waypoint
async function getPointInfos(waypoint) {
    let toleranceRadius = 200;
    let waypointLatLng = L.latLng(waypoint.lat, waypoint.lng);

    let url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${waypointLatLng.lat}&lon=${waypointLatLng.lng}&zoom=13&addressdetails=1&radius=${toleranceRadius}&extratags=0&namedetails=0`;

    try {
        let response = await fetch(url, {timeout: 10000});
        let data = await response.json();

        let adressInfos = {
            city : data.address.city || data.address.town || data.address.village || data.address.suburb || data.address.hamlet || "Ville non reconnue",
            department : data.address.county || "Région non reconnue",
            region: data.address.state || "Département non reconnu"
        };
        return adressInfos;
    }
    catch (error){
        console.error('Erreur lors du géocodage inversé:', error);
        return null;
    }
}

// get city name, department, region of many waypoints
async function getPointsInfos(waypoints) {
    let pointsInfos = [];

    // using "for of" because "foreach" doesn't support promises awaiting
    for (let waypoint of waypoints) {
        let infos = await getPointInfos(waypoint);
        pointsInfos.push(infos);
    }

    return pointsInfos;
}