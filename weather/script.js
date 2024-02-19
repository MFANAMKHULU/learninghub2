// Function to fetch weather data from the API
function getWeather() {
    const apiUrl = 'https://api.weather.gov/gridpoints/MTR/84,105/forecast';

    // Fetch data from the API
    fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
            // Once data is received, call the displayWeather function
            displayWeather(data);
        })
        .catch(error => {
            // Log an error message if there's an issue fetching data
            console.error('Error fetching weather data:', error);
        });
}

// Function to display weather information on the webpage
function displayWeather(data) {
    const weatherContainer = document.getElementById('weather-container');
    weatherContainer.innerHTML = '';

    // Extract the first three periods (days) from the forecast data
    const forecastData = data.properties.periods.slice(0, 3);

    // Loop through each period and create a weather card
    forecastData.forEach(period => {
        const forecastCard = document.createElement('div');
        forecastCard.className = 'weather-card';
        
        // Populate the weather card with period name, detailed forecast, and formatted date
        forecastCard.innerHTML = `<strong>${period.name}</strong><p>${period.detailedForecast}</p><div class="date">${formatDate(period.startTime)}</div>`;
        
        // Append the weather card to the weather container
        weatherContainer.appendChild(forecastCard);
    });
}

// Function to format a date string into a readable format
function formatDate(dateString) {
    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    const date = new Date(dateString);
    
    // Use the toLocaleDateString method to format the date
    return date.toLocaleDateString('en-US', options);
}
