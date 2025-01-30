fetch('http://api.weather.com/weather?city=London')
    .then(response => response.json())
    .then(data => {
        console.log(`Temperature in London: ${data.temperature}`)
    })
    .catch(error => console.error('Error:', error));