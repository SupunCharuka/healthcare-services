let map;
let marker;
let directionsService;
let directionsRenderer;

function initMap() {
    const latitudeElement = document.getElementById("latitude");
    const longitudeElement = document.getElementById("longitude");

    const latitude = parseFloat(latitudeElement.getAttribute("data-latitude"));
    const longitude = parseFloat(
        longitudeElement.getAttribute("data-longitude")
    );

    const myLatLng = {
        lat: latitude,
        lng: longitude,
    };

    map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: myLatLng,
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        map: map,
    });

    marker = new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Destination",
    });

    map.addListener("click", function (event) {
        showDirectionsFromCurrentLocation(event.latLng);
    });

    // Track and update current location
    // setInterval(updateCurrentLocation, 5000); // Update every 5 seconds
}

function showDirections() {
    navigator.geolocation.getCurrentPosition(
        function (position) {
            const currentLatLng = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };

            showDirectionsFromCurrentLocation(currentLatLng);
        },
        function (error) {
            console.log("Error retrieving current location:", error);
        }
    );
}

function showDirectionsFromCurrentLocation(destinationLatLng) {
    const request = {
        origin: marker.getPosition(),
        destination: destinationLatLng,
        travelMode: google.maps.TravelMode.DRIVING,
    };

    directionsService.route(request, function (response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(response);
        } else {
            console.log("Directions request failed due to " + status);
        }
    });
}

function updateCurrentLocation() {
    navigator.geolocation.getCurrentPosition(
        function (position) {
            const currentLatLng = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
            };

            // Update marker position
            marker.setPosition(currentLatLng);

            // Uncomment the following line if you want to show directions from the updated current location
            // showDirectionsFromCurrentLocation(currentLatLng);
        },
        function (error) {
            console.log("Error retrieving current location:", error);
        }
    );
}

window.initMap = initMap;
