<?php
session_start();
$conn = require 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check in `users` table
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_id'] = $user['username'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['logged_username'] = $user['fullname'];
        header("Location: admin/dashboard.php");
        exit();
    } else {
        // Check in `studentaccount` table
        $stmt2 = $conn->prepare("SELECT * FROM studentaccount WHERE username = ? AND password = ?");
        if ($stmt2 === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt2->bind_param("ss", $username, $password);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            $student = $result2->fetch_assoc();
            $_SESSION['user_id'] = $student['username'];
            $_SESSION['user_name'] = $student['username'];
            $_SESSION['logged_username'] = $student['fullname'];
            header("Location: student/dashboard_student.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }

        // Close the second statement
        $stmt2->close();
    }

    // Close the first statement
    $stmt->close();
    // Close the connection
    $conn->close();
}
?>

<!-- Display error if exists -->
<?php if (isset($error)) : ?>
    <p><?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
