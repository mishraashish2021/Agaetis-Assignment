<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Weather Forecast</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            margin-right: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .reload-icon {
            display: none;
        }

        .weather-table {
            background-color: #000;
            color: #fff;
            border-radius: 5px;
            padding: 10px;
            margin-top: 10px;
        }

        .weather-table {
            width: 100%;
            border-collapse: collapse;
        }

        .weather-table th, .weather-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .weather-table th {
            background-color: #333;
            color: white;
        }

        .weather-table tr:hover {
            background-color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Weather Forecast</h1>
        <div class="search-container">
            <input type="text" id="location" placeholder="Enter location..." required>
            <button onclick="searchWeather()">Search</button>
            <i id="reload-icon" class="reload-icon fas fa-sync-alt" style="display: none; margin: 10px 10px 10px 10px; font-size: 24px;"></i>
        </div>
        <div id="weather-info"></div>
    </div>

    <script>
        function searchWeather() {
            //For Hiding previous weather information
            document.getElementById("weather-info").innerHTML = "";

            // Show the reload icon
            document.getElementById("reload-icon").style.display = "block";

            // Get the location input value
            var location = document.getElementById("location").value;

            // Check if location is empty
            if (!location.trim()) {
                // Hide the reload icon
                document.getElementById("reload-icon").style.display = "none";
                alert("Please enter a location");
                return; 
            }

            // Fetch weather data only if location is exist
            fetch("/weather?location=" + location)
                .then(response => response.json())
                .then(data => {
                    displayWeather(data);
                    // Hide the reload icon after updating the UI
                    document.getElementById("reload-icon").style.display = "none";
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Hide the reload icon on error
                    document.getElementById("reload-icon").style.display = "none";
                });
        }


        function displayWeather(data) {
            var weatherInfo = document.getElementById("weather-info");
            var description = data.list[0].weather[0].description.charAt(0).toUpperCase() + data.list[0].weather[0].description.slice(1);
            var cityName = data.city.name;
            var currentTemp = data.list[0].main.temp;
            var windSpeed = data.list[0].wind.speed;
            var humidity = data.list[0].main.humidity;
            var windDirection = data.list[0].wind.deg;
            var cloudIconUrl = "https://openweathermap.org/img/w/" + data.list[0].weather[0].icon + ".png";
            var currentWeatherHtml = "<div style='background-color: #e0f2f1; padding: 10px; text-align: center;'>";
            currentWeatherHtml += "<div style='display: flex; align-items: center; justify-content: center;'>";
            currentWeatherHtml += "<div style='font-size: 30px; padding-right: 20px;'>" + cityName + "</div>";
            currentWeatherHtml += "<div style='font-size: 30px;'>"+ currentTemp + "°C </div>";
            currentWeatherHtml += "<div style='text-align: left; margin-left: 20px;'>";
            currentWeatherHtml += "<strong>Conditions:</strong> " + description + " | ";
            currentWeatherHtml += "<strong>Wind Speed:</strong> " + windSpeed + " m/s | ";
            currentWeatherHtml += "<strong>Humidity:</strong> " + humidity + "% | ";
            currentWeatherHtml += "<strong>Wind Direction:</strong> " + windDirection;
            currentWeatherHtml += "° </div>";
            currentWeatherHtml += "</div>";
            currentWeatherHtml += "</div>";

            var tableHtml = "<table class='weather-table'>";
            tableHtml += "<tr><th>Date</th><th>Weather</th><th>Min Temp (°C)</th><th>Max Temp (°C)</th></tr>";
            data.list.forEach(day => {
            var date = new Date(day.dt * 1000); // Convert timestamp to date object
            var dateString = date.toDateString();
            var weatherDescription = day.weather[0].description.charAt(0).toUpperCase() + day.weather[0].description.slice(1);
            var minTemp = day.main.temp_min;
            var maxTemp = day.main.temp_max;
            var iconUrl = "https://openweathermap.org/img/w/" + day.weather[0].icon + ".png";

            tableHtml += "<tr>";
            tableHtml += "<td>" + dateString + "</td>";
            tableHtml += "<td><img src='" + iconUrl + "' alt='" + weatherDescription + "' title='" + weatherDescription + "' style='vertical-align: middle;'> <span style='vertical-align: middle;'>" + weatherDescription.charAt(0).toUpperCase() + weatherDescription.slice(1) + "</span></td>";
            tableHtml += "<td>" + minTemp + "</td>";
            tableHtml += "<td>" + maxTemp + "</td>";
            tableHtml += "</tr>";
        });
        tableHtml += "</table>";
        weatherInfo.innerHTML = currentWeatherHtml + tableHtml;
    }
    </script>
</body>
</html>
