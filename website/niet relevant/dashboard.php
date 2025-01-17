<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luchtkwaliteit Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f9;
            font-family: Arial, sans-serif;
        }
        .card {
            margin: 20px;
        }
        .container {
            margin-top: 50px;
        }
        .user-details {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .user-details p {
            margin: 0;
            font-size: 16px;
        }
        .user-details a {
            text-decoration: none;
            color: #007bff;
        }
        .user-details a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="user-details">
            <p><strong>Luchtkwaliteit Dashboard</strong></p>
            <?php
            echo '<p>Email: ' . htmlspecialchars($user['email']) . '</p>';
            echo '<p>Welkom, ' . htmlspecialchars($user['name']) . '</p>';
            ?>
            <a href="logout.php">Log Uit</a>
        </div>

        <h1 class="text-center mb-4">Luchtkwaliteit Dashboard</h1>
        <div class="row" id="dashboard">
            <!-- Gegevens worden hier geladen via PHP -->
            <?php
            // Databaseverbinding
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'auth';

            $conn = new mysqli($host, $user, $password, $database);

            // Controleren of de verbinding werkt
            if ($conn->connect_error) {
                die("Verbinding mislukt: " . $conn->connect_error);
            }

            // Query om de laatste gegevens op te halen
            $sql = "SELECT co2, luchtvochtigheid, temperatuur FROM Luchtkwaliteit";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='col-md-4'>";
                    echo "    <div class='card text-center'>";
                    echo "        <div class='card-body'>";
                    echo "            <h5 class='card-title'>CO2 (ppm)</h5>";
                    echo "            <p class='card-text'>" . htmlspecialchars($row['co2']) . " ppm</p>";
                    echo "        </div>";
                    echo "    </div>";
                    echo "</div>";

                    echo "<div class='col-md-4'>";
                    echo "    <div class='card text-center'>";
                    echo "        <div class='card-body'>";
                    echo "            <h5 class='card-title'>Luchtvochtigheid (%)</h5>";
                    echo "            <p class='card-text'>" . htmlspecialchars($row['luchtvochtigheid']) . "%</p>";
                    echo "        </div>";
                    echo "    </div>";
                    echo "</div>";

                    echo "<div class='col-md-4'>";
                    echo "    <div class='card text-center'>";
                    echo "        <div class='card-body'>";
                    echo "            <h5 class='card-title'>Temperatuur (°C)</h5>";
                    echo "            <p class='card-text'>" . htmlspecialchars($row['temperatuur']) . "°C</p>";
                    echo "        </div>";
                    echo "    </div>";
                    echo "</div>";
                }
            } else {
                echo "<p class='text-center'>Geen gegevens beschikbaar</p>";
            }

            $conn->close();
            ?>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>