<?php
session_start();
$conn = require 'config/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
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
        $_SESSION['user_id'] = $user['userID'];
        $_SESSION['user_name'] = $user['username'];
        $_SESSION['userrole'] = $user['userRole'];
        $_SESSION['logged_username'] = $user['fullname'];



        if ($user['userRole'] == 1) {
            header("Location: admin/dashboard.php");
            exit();
        }
        else if ($user['userRole'] == 2) {
            header("Location: registrar/dashboard.php");
            exit();
        }
    } else {
        // Check in `studentaccount` table
        $stmt2 = $conn->prepare("SELECT * FROM students WHERE email = ? AND password = ?");
        if ($stmt2 === false) {
            die("Prepare failed: " . htmlspecialchars($conn->error));
        }
        $stmt2->bind_param("ss", $username, $password);
        $stmt2->execute();
        $result2 = $stmt2->get_result();

        if ($result2->num_rows > 0) {
            $student = $result2->fetch_assoc();
            $_SESSION['user_id'] = $student['tempID'];
            $_SESSION['userrole'] = $student['userRole'];
            $_SESSION['logged_username'] = $student['firstname'].' '.$student['lastname'];


            header("Location: student/dashboard.php");
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
