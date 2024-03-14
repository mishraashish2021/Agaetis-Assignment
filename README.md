# Weather Forecast Project

## Description
This project provides a weather forecast application using Laravel and the OpenWeatherMap API.

## Laravel Setup
1. Clone the repository:
- https://github.com/mishraashish2021/Agaetis-Assignment

2. Install dependencies:
- composer install

3. Configure environment variables:
- Rename `.env.example` to `.env`.
- Set up your environment variables in the `.env` file, including API keys.

4. Serve the application:
- php artisan serve

## Usage
- Access the application through a web browser.
- Enter a location in the search field and click "Search" to retrieve the weather forecast.

## Routes and Controller Functions
- **Home Route**: 
- `/`: This route is associated with the `index` function of the `WeatherController` class. It serves as the homepage of the application.

- **Weather Route**:
- `/weather`: This route is associated with the `getWeather` function of the `WeatherController` class. It is used to retrieve weather data from the OpenWeatherMap API based on the specified location.

## API Key
The project utilizes the OpenWeatherMap API to fetch weather data. To use the API, you need to obtain an API key from the OpenWeatherMap website (https://openweathermap.org/api) and configure it in the `.env` file under the `OPENWEATHERMAP_API_KEY` variable or directy use api_key
- apiKey = 'c05d4bbe3e8895495a8c42a093bbef18';
- apiUrl = "https://api.openweathermap.org/data/2.5/forecast?q=$location&appid=$apiKey&units=metric&cnt=7";


## License
This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).


