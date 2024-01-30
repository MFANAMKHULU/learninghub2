// getRoutes.js
document.addEventListener("DOMContentLoaded", function () {
    // Bus Type Dropdown Change Event
    $('#busType').change(function () {
        // Get the selected bus type
        const selectedBusType = $(this).val();

        // Fetch routes for the selected bus type
        fetchRoutes(selectedBusType);
    });

    // Function to fetch and display routes
    function fetchRoutes(busType) {
        // Fetch route data from the PHP script based on the selected bus type
        fetch('fetchroutes.php?busType=' + busType)
            .then(response => response.json())
            .then(data => {
                // Get the route dropdown element
                const routeDropdown = $('#routeDropdown');

                // Clear existing options
                routeDropdown.empty();

                // Add default option
                routeDropdown.append($('<option>').text('Select a route'));

                // Add routes to the dropdown
                data.routes.forEach(route => {
                    routeDropdown.append($('<option>').text(`${route.departing_city} to ${route.destination_city}`).val(route.route_id));
                });
            })
            .catch(error => console.error('Error fetching routes:', error));
    }
});
