<?php
// ==============================
// CONFIGURATIE
// ==============================
$apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=52.37&longitude=4.89&current_weather=true";

$error = null;
$weatherData = null;

// ==============================
// API AANROEP MET cURL
// ==============================
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if (curl_errno($ch)) {
    $error = "cURL-fout: " . curl_error($ch);
}

curl_close($ch);

// ==============================
// FOUTAFHANDELING
// ==============================
if (!$error && $httpCode !== 200) {
    $error = "API-fout. HTTP-statuscode: " . $httpCode;
}

if (!$error) {
    $weatherData = json_decode($response, true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $error = "JSON-fout bij het verwerken van de API-response.";
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Weer in Amsterdam</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 300px;
        }

        h1 {
            margin-bottom: 15px;
        }

        .loading {
            color: #666;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        .weather {
            font-size: 18px;
        }
    </style>
</head>
<body>

<div class="card">
    <h1>🌦 Weer in Amsterdam</h1>

    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>

    <?php elseif (!$weatherData): ?>
        <p class="loading">Gegevens laden...</p>

    <?php else: ?>
        <div class="weather">
            <p>🌡 Temperatuur: 
                <strong><?= htmlspecialchars($weatherData['current_weather']['temperature']) ?> °C</strong>
            </p>
            <p>💨 Windsnelheid: 
                <strong><?= htmlspecialchars($weatherData['current_weather']['windspeed']) ?> km/u</strong>
            </p>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
