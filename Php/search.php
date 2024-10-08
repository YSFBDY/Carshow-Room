<?php
// Replace these variables with your actual database connection details
$servername = "localhost";
$username = "root";
$password = "";
$database = "motors";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize an empty array to store the query results
$results = [];

// Execute the SQL query
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve selected values from the form
    $year = $_POST["year"];
    $body_style = $_POST["body_style"];
    $make = $_POST["make"];
    $car_condition = $_POST["car_condition"];
    $transmission_type = $_POST["transmission_type"];
    $price = $_POST["price"];

    // Construct the SQL query
    $query = "SELECT * FROM car WHERE ";
    $conditions = [];

    // Add conditions based on selected filters
    if ($year != "none") {
        $conditions[] = "year = '$year'";
    }
    if ($body_style != "none") {
        $conditions[] = "style  = '$body_style'";
    }
    if ($make != "none") {
        $conditions[] = "make = '$make'";
    }
    if ($car_condition != "none") {
        $conditions[] = "condition_  = '$car_condition'";
    }
    if ($transmission_type != "none") {
        $conditions[] = "Trans  = '$transmission_type'";
    }
    if ($price != "none") {
        $conditions[] = "price < '$price'";
    }

    // Combine all conditions into a single WHERE clause
    if (!empty($conditions)) {
        $query .= implode(" AND ", $conditions);
    } else {
        // If no filters are selected, select all cars
        $query .= "1"; // Dummy condition to return all rows
    }

    // Execute the query
    $result = $conn->query($query);

    // Check if the query was successful
    if ($result === false) {
        echo "Error executing query: " . $conn->error;
    } else {
        // Fetch the results and store them in the $results array
        while ($row = $result->fetch_assoc()) {
            $results[] = $row;
        }
    }

    // Close the database connection
    $conn->close();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <!-- Your CSS includes here -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .car {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .car h2 {
            font-family: 'Rufina', serif;
            color: #333;
            margin-top: 0;
        }

        .car img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .car p {
            margin: 0;
            color: #777;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Search Results</h1>
    <!-- Display your search results here -->
    <?php
    // Output the results
    foreach ($results as $car) {
        echo "<div class='car'>";
        echo "<h2>" . $car['make'] . "</h2>";
        echo "<p>Year: " . $car['Year'] . "</p>";
        echo "<p>Body Style: " . $car['style'] . "</p>";
        echo '<img src="assets/images/featured-cars/' . $car['IMG'] . '" alt="cars">';
        // Add more details as needed
        echo "</div>";
    }
    ?>
</div>

</body>
</html>

