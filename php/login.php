<?php
include('connection.php');
// Get form data
$user = $_POST['username'];
$pass = $_POST['password'];

// Hash the password (for checking against the hashed password stored in the database)
$hashed_pass = md5($pass); // MD5 is used here for simplicity, use a stronger hashing algorithm like bcrypt in production

// Prepare and execute the SQL query
$sql = "SELECT * FROM users WHERE username=? AND password=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user, $hashed_pass);
$stmt->execute();
$result = $stmt->get_result();

// Check if a user exists
if ($result->num_rows > 0) {
    // Start session and set session variables
    session_start();
    $_SESSION['username'] = $user;
    header("Location: index.php"); // Redirect to a protected page
} else {
    echo "Invalid username or password.";
}

$stmt->close();
$conn->close();








?>