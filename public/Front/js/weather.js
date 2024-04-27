function getWeather(event) {
    // Prevent default form submission behavior
    event.preventDefault();

    const city = document.getElementById('city').value;

    if (!city) {
        alert('Please enter a city');
        return;
    }

    const form = document.getElementById('weather-search-form');
    fetch(form.action, {  // Use form's action attribute
        method: 'POST',
        body: new URLSearchParams(new FormData(form)) // Encode form data
    })
        .then(response => response.json())
        .then(data => {
            displayWeather(data);
        })
        .catch(error => {
            console.error('Error fetching weather data:', error);
            alert('Error fetching weather data. Please try again.');
        });
}