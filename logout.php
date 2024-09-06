<?php
// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Check if session variables are still set
if (session_status() === PHP_SESSION_NONE) {
    // Session is destroyed and no session variables are set, proceed with redirection
    header('Location: index.php');
} else {
    // Session is not destroyed properly, handle the error (optional)
    echo 'Error: Session could not be destroyed.';
}

// Ensure that no further code is executed
exit();
?>
