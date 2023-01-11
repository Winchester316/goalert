<script defer>
        // Get all the button elements with the class name 'map-button'
        const buttons = document.querySelectorAll(".open-map-direction-btn");

        // Get the Bootstrap modal element
        const modal = document.getElementById("modalLoadMap");

        // Get the close button element
        const closeButton = document.querySelector(".modal-footer .close");

        // Create a map object
        var map;

        // Create a marker object
        var marker;

        // Add click event listeners to the buttons
        buttons.forEach(button => {
            button.addEventListener("click", event => {

                event.preventDefault();

                // Get the button that was clicked
                var targetButton = event.currentTarget;

                // Get the latitude and longitude from the button's data attributes
                var latitude = targetButton.getAttribute("data-latitude");
                var longitude = targetButton.getAttribute("data-longitude");

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

            // Reset the map and marker
            marker.setMap(null);
            map = undefined;
            marker = undefined;
        });

        // Initialize the map
        function initMap(location) {
            // Create the map options
            var mapOptions = {
                zoom: 14,
                center: location
            };

            // Create the map
            map = new google.maps.Map(document.getElementById("map"), mapOptions);

            // Add a marker for the location
            marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
