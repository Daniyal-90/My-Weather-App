<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .first-section { background: url(images/bg-image.jpg) center/cover no-repeat; display: flex; align-items: center; justify-content: center; height: 100vh; position: relative; }
        .first-section:before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(64, 171, 230, 0.25); z-index: 1; }
        .container { position: relative; z-index: 2; background: transparent; padding: 20px 40px; text-align: center; max-width: 400px; width: 100%; }
        #location { background: #fff; }
        h1, label, input[type="text"], button { color: white; }
        input[type="text"] { width: 100%; padding: 10px; border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 5px; margin-bottom: 20px; font-size: 16px; background-color: rgba(255, 255, 255, 0.2); color: white; }
        button { padding: 10px 20px; font-size: 16px; color: white; background-color: rgba(22, 99, 188, 0.8); border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s ease; }
        button:hover { background-color: rgba(53, 122, 189, 0.8); }
        .weather-info { margin-top: 20px; text-align: center; padding: 15px; background-color: rgba(0, 0, 0, 0.5); border-radius: 10px; color: white; }
        .weather-info h2, .weather-info p { font-size: 18px; margin: 5px 0; }
        .error { color: #e74c3c; font-weight: bold; }
    </style>
</head>
<body>
    <section class="first-section">
        <div class="container">
            <h1>Weather App</h1>
            <form method="POST">
                <label for="location">Enter City Or Zip Code:</label><br><br>
                <input type="text" id="location" name="location" required placeholder="e.g., london">
                <button type="submit" name="get_weather">Get Weather</button>
            </form>
            <div class="weather-info">
                <?php
                if (isset($_POST['get_weather'])) {
                    $location = urlencode(trim($_POST['location']));
                    $apiUrl = "http://api.weatherapi.com/v1/current.json?key=baf415756a62487487a170958240711&q=$location&aqi=no";
                    $weatherData = @file_get_contents($apiUrl);
                    if ($weatherData) {
                        $weatherArray = json_decode($weatherData, true);
                        if (isset($weatherArray['location'])) {
                            echo "<h2>Weather in {$weatherArray['location']['name']}, {$weatherArray['location']['country']}</h2>";
                            echo "<p>Temperature: {$weatherArray['current']['temp_c']} °C</p>";
                            echo "<p>Condition: {$weatherArray['current']['condition']['text']}</p>";
                        } else echo "<p class='error'>Location not found. Please try again.</p>";
                    } else echo "<p class='error'>Unable to fetch weather data. Please check your input or try again later.</p>";
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>
