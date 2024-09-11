<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ridpathdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a unique tempID
function generateUniqueTempID($conn) {
    $count = 0; // Initialize $count
    
    do {
        // Generate a random number for tempID
        $tempID = mt_rand(100000, 999999); // Adjust range as needed

        // Check if the generated tempID already exists in the studentaccount table
        $stmt = $conn->prepare("SELECT COUNT(*) FROM studentaccount WHERE tempID = ?");
        $stmt->bind_param("i", $tempID);
        $stmt->execute();
        $stmt->bind_result($count);
        $stmt->fetch();
        $stmt->close();

    } while ($count > 0); // Repeat if tempID already exists

    return $tempID;
}

// Process registration form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];

    // Validate data
    if ($password !== $repeatPassword) {
        header('Location: register_form.php?error=password_mismatch');
        exit;
    }

    // Create username by concatenating first name and last name
    $username = $lastName . $firstName;

    // Generate a unique tempID
    $tempID = generateUniqueTempID($conn);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO studentaccount (tempID, firstname, lastname, email, password, username) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssss", $tempID, $firstName, $lastName, $email, $password, $username);

    // Execute the statement
    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
