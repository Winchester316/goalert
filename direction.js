<script defer>
        var map, marker, currentLocationMarker;
        var latitude = null,
            longitude = null;

        // Get all the button elements with the class name 'map-button'
        const buttons = document.querySelectorAll(".open-map-direction-btn");

        // Get the Bootstrap modal element
        const modal = document.getElementById("modalLoadMap");

        // Get the close button element
        const closeButton = document.querySelector(".modal-footer .close");

        // Add click event listeners to the buttons
        buttons.forEach(button => {
            button.addEventListener("click", event => {

                event.preventDefault();

                // Get the button that was clicked
                var targetButton = event.currentTarget;

                // Get the latitude and longitude from the button's data attributes
                latitude = targetButton.getAttribute("data-latitude");
                longitude = targetButton.getAttribute("data-longitude");

                if (!latitude || !longitude) {
                    throw new Error('Missing data-latitude or data-longitude attributes on the button element')
                }

                // Create a LatLng object for the location
                var location = new google.maps.LatLng(latitude, longitude);

                // Debug
                // console.log(`The Latitude: ${latitude} Longitude: ${longitude}`);

                // Initialize the map
                initMap(location);

                // Show the modal
                modal.classList.add("show");
            });
        });

        // Add a click event listener to the close button
        closeButton.addEventListener("click", event => {
            // Hide the modal
            modal.classList.remove("show");
            // Remove the marker from the map
            marker.setMap(null);
            // Remove the direction from the map
            directionsRenderer.setMap(null);
            // Reset the map, marker and directionRenderer object
            map = undefined;
            marker = undefined;
            directionsRenderer = undefined;
        });


        // Initialize the map
        function initMap(location) {
            // Get the destination coordinates from the location parameter
            var destinationLat = location.lat();
            var destinationLng = location.lng();

            if (isNaN(destinationLat) || isNaN(destinationLng)) {
                throw new Error("destination coordinates must be a number")
            }

            // Create a map object
            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 14,
                center: location
            });

            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(
                    function(position) {
                        var currentLocation = {
                            lat: position.coords.latitude,
                            lng: position.coords.longitude,
                        };
                        // Create a DirectionsService object
                        var directionsService = new google.maps.DirectionsService();

                        // Create a DirectionsRenderer object
                        var directionsRenderer = new google.maps.DirectionsRenderer({
                            map: map,
                            suppressMarkers: false, // Don't show markers for the origin and destination
                        });



                        // Set the origin and destination for the route
                        var request = {
                            origin: currentLocation,
                            destination: {
                                lat: destinationLat,
                                lng: destinationLng
                            },
                            travelMode: "DRIVING",
                        };

                        // Get the route and display it on the map
                        directionsService.route(request, function(response, status) {
                            if (status == "OK") {
                                // Remove the old marker from the map
                                if (currentLocationMarker) {
                                    currentLocationMarker.setMap(null);
                                }

                                // Create a new marker for the current location
                                currentLocationMarker = new google.maps.Marker({
                                    position: currentLocation,
                                    map: map,
                                    title: "Your location",
                                    icon: "https://maps.google.com/mapfiles/ms/icons/blue-dot.png",
                                });

                                // Set the route on the DirectionsRenderer object
                                directionsRenderer.setDirections(response);
                            }
                        });
                    },
                    function() {
                        handleLocationError(true, infoWindow, map.getCenter());
                    }
                );
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }


        // Function to get the value of a URL parameter
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
            var results = regex.exec(location.search);
            return results === null ?
                "" :
                decodeURIComponent(results[1].replace(/\+/g, " "));
        }

        // Function to handle geolocation errors
        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(
                browserHasGeolocation ?
                "Error: The Geolocation service failed." :
                "Error: Your browser doesn't support geolocation."
            );
            infoWindow.open(map);
        }
    </script>
