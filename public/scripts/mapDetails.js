let map = L.map('mapDetails').setView([46.6035, 1.888334], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

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

                let route = data.features[0].properties;
                displayGPS(route);

            })
            .catch(error => console.error(error));

        
    }
}

function displayGPS(route) {
    let gps = document.querySelector('#gps');

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
    }
}
