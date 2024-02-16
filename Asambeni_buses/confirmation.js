$(document).ready(function () {
    // Fetch booking details after payment (this could be done server-side)
    fetchBookingDetails();

    // You can add additional logic or API calls here
});

function fetchBookingDetails() {
    // Assuming you have a server endpoint to fetch booking details
    // Replace this with actual implementation
    const bookingDetails = {
        busType: "INTERCAPE",
        route: "Johannesburg to Cape Town",
        date: "2024-12-15",
        departureTime: "10:00 AM",
        arrivalTime: "5:00 PM",
        numChildren: 2,
        numAdults: 1,
        name: "John",
        surname: "Doe",
        id: "123456789",
        email: "john@example.com",
        totalPrice: 500.00,
        // Add more details as needed
    };

    displayTicketDetails(bookingDetails);
}

function displayTicketDetails(details) {
    const ticketDetailsContainer = $("#ticketDetailsContainer");

    const ticketDetailsHTML = `
        <h3>Your Ticket Details</h3>
        <p><strong>Coach Company:</strong> ${details.busType}</p>
        <p><strong>Route:</strong> ${details.route}</p>
        <p><strong>Date of Travel:</strong> ${details.date}</p>
        <p><strong>Departure Time:</strong> ${details.departureTime}</p>
        <p><strong>Arrival Time:</strong> ${details.arrivalTime}</p>
        <p><strong>Number of Children:</strong> ${details.numChildren}</p>
        <p><strong>Number of Adults:</strong> ${details.numAdults}</p>
        <p><strong>Name:</strong> ${details.name} ${details.surname}</p>
        <p><strong>ID Number:</strong> ${details.id}</p>
        <p><strong>Email:</strong> ${details.email}</p>
        <p><strong>Total Price:</strong> ${details.totalPrice.toFixed(2)}</p>
        <!-- Add more details as needed -->
    `;

    ticketDetailsContainer.html(ticketDetailsHTML);
}
