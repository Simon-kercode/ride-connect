let map = L.map('mapDetails').setView([46.6035, 1.888334], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

let startIcon = L.icon({
    iconUrl: 'api/style/images/marker-icon-green.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowUrl: 'api/style/images/marker-shadow.png',
    shadowSize: [41, 41],
    shadowAnchor: [12, 41],
    iconColor: 'red'
})
let endIcon = L.icon({
    iconUrl: 'api/style/images/marker-icon-red.png',
    iconSize: [25, 41],
    iconAnchor: [12, 41],
    popupAnchor: [1, -34],
    shadowUrl: 'api/style/images/marker-shadow.png',
    shadowSize: [41, 41],
    shadowAnchor: [12, 41],
    iconColor: 'red'
})
function createRoute(waypoints) {
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
                routeLayer = L.geoJSON(data).addTo(map)
                map.fitBounds(routeLayer.getBounds())
                
                L.marker([data.metadata.query.coordinates[0][1], data.metadata.query.coordinates[0][0]], {icon: startIcon}).addTo(map);
                L.marker([data.metadata.query.coordinates[data.metadata.query.coordinates.length -1][1], 
                    data.metadata.query.coordinates[data.metadata.query.coordinates.length -1][0]], {icon: endIcon}).addTo(map);
                // L.marker([waypoints[0].lng, waypoints[0].lat]).addTo(map);



                let route = data.features[0].properties;
                displayGPS(route);

            })
            .catch(error => {
                let mapError = document.createElement('p');
                mapError.className = "error";
                mapError.textContent = "Erreur lors de la restitution de l'itinéraire."
                mapError.parentNode.insertBefore(mapError, map.nextSibling);
            });
    }
}

function displayGPS(route) {
    let gps = document.querySelector('#gpsContainer');
    let displayGpsBtn = document.querySelector('#displayGpsBtn');
    let hideGpsBtn = document.querySelector('#hideGpsBtn');

    let waypointsList = route.way_points;
    let instructionsList = route.segments;

    if (waypointsList.length >= 2) {
        for (let i = 0; i < waypointsList.length - 1; i++) {

            let accordionButton = document.createElement("button");
            accordionButton.classList.add('accordion');
            accordionButton.innerText = `Etape ${i + 1}`;

            let panel = document.createElement('div');
            panel.classList.add('panel');

            for (let j = 0; j < instructionsList[i].steps.length; j++) {

                if (instructionsList[i].steps[j].type !== 10) {
                    let instructionLine = document.createElement("p");
                    instructionLine.innerText = instructionsList[i].steps[j].instruction;
                    panel.appendChild(instructionLine);
                }
                else {
                    let instructionLine = document.createElement("p");
                    instructionLine.innerText = instructionsList[i].steps[j].instruction;
                    panel.appendChild(instructionLine);
                    break;
                }
            }
            gps.appendChild(accordionButton);
            gps.appendChild(panel);
            
            accordionButton.addEventListener("click", function () {
                this.classList.toggle("active");

                let nextPanel = this.nextElementSibling;
                if (nextPanel.style.maxHeight) {
                    nextPanel.style.maxHeight = null;
                  } else {
                    nextPanel.style.maxHeight = nextPanel.scrollHeight + "px";
                  }
            });
        }
        displayGpsBtn.addEventListener('click', function() {
            gps.style.display = 'block';
            displayGpsBtn.style.display = 'none';
            hideGpsBtn.style.display = 'block';
        });

        hideGpsBtn.addEventListener('click', function() {
            gps.style.display = 'none';
            displayGpsBtn.style.display = 'block';
            hideGpsBtn.style.display = 'none';
        
        })
    }
}
