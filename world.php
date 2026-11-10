<?php
$host = "localhost";
$username = "lab5_user";
$password = "password123";
$database = "world";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup  = isset($_GET['lookup']) ? $_GET['lookup'] : '';

if ($lookup === 'cities') {
    $sql = "SELECT ci.name AS name, ci.district, ci.population
            FROM cities ci
            JOIN countries co ON ci.country_code = co.code
            WHERE co.name LIKE '%$country%'";
    $result = $conn->query($sql);

    echo "<table>";
    echo "<tr><th>Name</th><th>District</th><th>Population</th></tr>";
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['district'] . "</td><td>" . $row['population'] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No cities found.</td></tr>";
    }
    echo "</table>";
} else {
    $sql = "SELECT * FROM countries WHERE name LIKE '%$country%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Country Name</th><th>Continent</th><th>Independence Year</th><th>Head of State</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['continent'] . "</td><td>" . $row['independence_year'] . "</td><td>" . $row['head_of_state'] . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found.</p>";
    }
}

$conn->close();
?>