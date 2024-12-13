<?php
$conn = require 'config/config.php';
session_start();

// // Function to generate a unique tempID
// function generateUniqueTempID($conn) {
//     $count = 0; // Initialize $count
    
//     do {
//         // Generate a random number for tempID
//         $tempID = mt_rand(100000, 999999); // Adjust range as needed

//         // Check if the generated tempID already exists in the studentaccount table
//         $stmt = $conn->prepare("SELECT COUNT(*) FROM studentaccount WHERE tempID = ?");
//         $stmt->bind_param("i", $tempID);
//         $stmt->execute();
//         $stmt->bind_result($count);
//         $stmt->fetch();
//         $stmt->close();

//     } while ($count > 0); // Repeat if tempID already exists

//     return $tempID;
// }

// Process registration form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contactnumber = $_POST['contactnumber'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $userrole = 4;
    $password = $_POST['password'];
    $repeatpassword = $_POST['repeatpassword'];
    $code = $_POST['code'];

    // Validate data
    if ($password !== $repeatpassword) {
        $_SESSION['action-error'] = "Passwords do not match";
        header('location: index.php');
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO students ( firstname, middlename, lastname, email, contactnumber, userRole, password, gender, birthday) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssisss", $firstname, $middlename, $lastname, $email, $contactnumber, $userrole, $password, $gender, $birthday);

    // Execute the statement
    if ($stmt->execute()) {
        //update code usage status
        mysqli_query($conn, "UPDATE registrationcodes SET used = 'Yes' WHERE code='$code'");

        $_SESSION['action-success'] = "Account created successfully";
        header('location: index.php');
        exit();
    } else {
        $_SESSION['action-error'] = "An error occurred. Please try again";
        header('location: index.php');
        exit();
    }
}
?>
