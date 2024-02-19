// Function to retrieve booking details from localStorage
function getBookingDetailsFromStorage() {
    const storedDetails = localStorage.getItem('bookingDetails');
    return storedDetails ? JSON.parse(storedDetails) : null;
}

// Fetch booking details after payment (this could be done server-side)
const bookingDetails = getBookingDetailsFromStorage();

if (bookingDetails) {
    displayTicketDetails(bookingDetails);
}
