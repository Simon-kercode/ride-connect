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
let routeInfos = null;
let waypoints = [];

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
map.on('draw:edited', function (e) {
    createRoute();
});
// marker deleted
map.on('draw:deleted', function (e) {
    createRoute();
});

document.querySelector('#orgaForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    let pointsInfosInput = document.querySelector('#pointsInfos');
    let routeInfosInput = document.querySelector('#routeInfos');
    let waypointsInput = document.querySelector('#waypoints');

    // getting infos points
    let pointsInfos = await getPointsInfos(waypoints);
        console.log(pointsInfos);
    
    pointsInfosInput.value = JSON.stringify(pointsInfos);
    routeInfosInput.value = JSON.stringify(routeInfos);
    waypointsInput.value = JSON.stringify(waypoints);
    
    document.getElementById('orgaForm').submit();
})

// function to draw itinerary between each marker and add it on the map.
function createRoute() {
     // Get markers coordinates
    waypoints = drawnItems.getLayers().map(layer => layer.getLatLng());
    // console.log(waypoints);
    
    if (startPointMarker !== null) {
        waypoints.unshift(startPointMarker._latlng);
    }

    // add draggable option to each marker
    drawnItems.eachLayer(layer => {
        layer.dragging.enable();
    });

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
            // deleting previous itinerary if a marker position is modified
            if (routeLayer !== null) {
                map.removeLayer(routeLayer);
            }

            routeLayer = L.geoJSON(data).addTo(map);
            let route = data.features[0].properties;

            routeInfos = {
                distance : route.summary.distance, //km;
                duration : route.summary.duration/60 //minutes;
            }
        })
        .catch(error => console.error(error));
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
        let url = 'https://nominatim.openstreetmap.org/search?format=json&q=' + startPoint;

        // Fetch town coordinates
        fetch(url)
        .then(response => 
          
                response.json()
            )
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


async function serverSubmit(data) {

    try {
        let response = await fetch('baladeSubmit', {
            method: 'POST',
            headers: {
                'Content-type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        console.log(response);
        let responseData = await response.json();
        console.log(responseData);
    }
    catch(error) {
        console.error("Erreur lors de l'envoi des données :",error);
    }
}