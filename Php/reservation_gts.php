<?php
// Retrieve form data
// Retrieve form data if available
$fullName = isset($_POST['full-name']) ? $_POST['full-name'] : '';
$nationalID = isset($_POST['national-id']) ? $_POST['national-id'] : '';
$nationality = isset($_POST['nationality']) ? $_POST['nationality'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$phoneNumber = isset($_POST['phone-number']) ? $_POST['phone-number'] : '';
$dateOfBirth = isset($_POST['date-of-birth']) ? $_POST['date-of-birth'] : '';
$cardholderName = isset($_POST['card-holder-name']) ? $_POST['card-holder-name'] : '';
$creditCardNumber = isset($_POST['credit-card-number']) ? $_POST['credit-card-number'] : '';
$expirationDate = isset($_POST['expiration-date']) ? $_POST['expiration-date'] : '';
$cvv = isset($_POST['cvv']) ? $_POST['cvv'] : '';
$car_model="Prochse 911 Carrera GTS";

// Insert the data into your database
$servername = "localhost"; // Change this to your server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "motors"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Prepare SQL statement
$sql = "INSERT INTO reservations (full_name, national_id, nationality, address, phone_number, date_of_birth, card_holder_name, credit_card_number, expiration_date, cvv,car_model) VALUES ('$fullName', '$nationalID', '$nationality', '$address', '$phoneNumber', '$dateOfBirth', '$cardholderName', '$creditCardNumber', '$expirationDate', '$cvv','$car_model')";
// Execute SQL statement
if ($conn->query($sql) === TRUE) {
    // Redirect to HTML page
    header("Location: Transaction.html");
    exit(); // Ensure that script execution stops after redirection
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
