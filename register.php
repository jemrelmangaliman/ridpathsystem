<?php
$conn = require 'config/config.php';

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
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];
    $userrole = 4;
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];

    // Validate data
    if ($password !== $repeatpassword) {
        header('Location: register_form.php?error=password_mismatch');
        exit;
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO students ( firstname, middlename, lastname, email, contactnumber, userRole, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssis", $firstname, $middlename, $lastname, $email, $contactnumber, $userrole, $password);

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
